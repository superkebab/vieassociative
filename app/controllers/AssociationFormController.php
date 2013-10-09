<?php

class AssociationFormController  extends BaseController {

    
    public $allowedOrigin = array('general-informations',
                                    'vieassociative-informations',
                                );
    /*
        @origin = the page name on the association control panel
        @item = the name of the input that the user wants to edit
        Controls the origin and the item before redering corresponding form
    */
    public function getForm($id,$origin,$item) {
        $view_name = 'form_association.'.$origin.'.'.$item;
        switch ($origin) {
            case 'general-informations':
                switch ($item) {
                    case 'name':
                    case 'legal_name':
                    case 'acronym':
                    case 'goal':
                    case 'official_date_creation':
                    case 'website_url':
                    case 'headquater':
                    case 'admitted_public_utility':
                    case 'internal_regulation':
                    case 'statuts':
                    case 'contact_adress':
                    $val = elo_Association::find($id)->$item;
                    return View::make($view_name)->with('val',$val);
                }
                break;
            case 'vieassociative-informations':
                switch ($item) {
                    case 'association_protection':
                    case 'association_categories':
                    case 'activities':
                    case 'services_between_partners':
                    case 'module_photo':
                    case 'module_evenement':
                    case 'module_social':
                    case 'module_sponsor':
                    case 'module_price':
                    case 'main_mail':
                    case 'welcome_text':
                        return View::make($view_name);
                }
                break;
        }
        return Response::view('errors.404', array(), 404);
    }
    public function postForm($id,$origin,$item) {
        $result = array('error'=>'no method found');
        switch ($origin) {
            case 'general-informations':
                $result = $this->generalInformations($id,$item);
                break;
            case 'vieassociative-informations':
                switch ($item) {
                    case 'association_protection':
                    case 'association_categories':
                    case 'activities':
                    case 'services_between_partners':
                    case 'module_photo':
                    case 'module_evenement':
                    case 'module_social':
                    case 'module_sponsor':
                    case 'module_price':
                    case 'main_mail':
                    case 'welcome_text':
                        return View::make($view_name);
                }
                break;
            case 'administrator':
                $v = new validators_associationAdministrator;
                if(Input::has('who')){
                    // if we don't know if he register himself or somebody else
                    $result = $v->add_when_not_admin();
                    if(isset($result['success'])){
                        if($result['data']['who']=='false'){
                            Association::addAdmin(Auth::user()->id,$id,$result['data']['link']);
                        }else{
                            $user = User::where('email', $result['data']['admin_mail'])->firstOrFail();
                            Association::addAdmin($user->id,$id,$result['data']['link']);
                        }
                    }
                }else{
                    // he is already an admin, he is adding somebody else
                    $result = $v->add_when_already_admin();
                    if(isset($result['success'])){
                        $user = User::where('email', $result['data']['admin_mail'])->firstOrFail();
                        Association::addAdmin($user->id,$id,$result['data']['link']);
                    }
                }
                //SECURITY ??
                if(isset($result['success'])){
                    $result['redirect_url'] = '/'.$id.'/edit/administrator';
                }
        }
        if(isset($result['success'])){
            $result['data']=null; //Remove data
        }
        return Response::json($result);
    }
    private function generalInformations($id,$item){
        $v = new validators_associationGeneralInformation;
        switch ($item) {
            case 'name':
            case 'legal_name':
            case 'acronym':
            case 'goal':
            case 'official_date_creation':
            case 'website_url':
            case 'headquater':
            case 'internal_regulation':
            case 'statuts':
            case 'contact_adress':
                $result = $v->$item();
                $update=array($item => $result['data'][$item]);
                $before = elo_Association::find($id)->first()->$item;
                $proposition = $result['data'][$item];
                break;
            case 'admitted_public_utility':
                $result = $v->$item();
                $boolean = ($result['data'][$item] == "true") ? 1 : 0; 
                $update = array($item => $boolean);
                $before = elo_Association::find($id)->first()->$item;
                $proposition = $boolean;
                break;
        }
        if(isset($result['success'])){
            if($this->isAdministrator()){
                //Apply the request right now
                elo_Association::where('id',$id)->update($update);
            }else{
                //Create a proposition
                $data['id_assoc'] = $id;
                $data['type'] = $item;
                $data['update'] = $update;
                $data['where'] = array('id'=>$id);
                $data['message'] = array('before'=>$before,
                                        'after'=>$proposition,
                                        'explanation'=>Lang::get('association/proposition/type.'.$item),
                                        'title'=>Lang::get('association/proposition/title.'.$item),
                                        'type_answer'=>(empty($before)) ? 2 : 1
                                    );
                Proposition::add($data);
            }
            $result['redirect_url'] = '/'.$id.'/edit/general-informations';
        }
        return $result;
    }
    public function isAdministrator(){
        return false;
    }
}