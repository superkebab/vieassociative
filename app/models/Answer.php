<?php
class Answer  extends Eloquent
{
    static function getAnswers($id_discussion){
        $result = elo_Answer::orderBy('level', 'DESC')->orderBy('id', 'ASC')->get();
        $commentsLevel3 = [];
        $commentsLevel2 = [];
        $comments = [];

        //Classify comments between their level
        foreach ($result as $k => $v) {
            switch ($v->level) {
                case 3:
                    $commentsLevel3[$v->id_answer][] = $v;
                    break;
                case 2:
                    $commentsLevel2[$v->id_answer][$v->id] = $v;
                    if(isset($commentsLevel3[$v->id])){
                        $commentsLevel2[$v->id_answer][$v->id]['child'] = $commentsLevel3[$v->id];
                    }
                    break;
                case 1:
                    $comments[$v->id] = $v;
                    if(isset($commentsLevel2[$v->id])){
                        $comments[$v->id]['child'] = $commentsLevel2[$v->id];
                    }
                    break;
            }
        }


        $return = [];
        // put all comments on an array of 1 dimension, as it will be writen on the HTML
        foreach ($comments as $k => $v) {
            $return[] = $v;
            if(isset($v['child'])){ // If there are 2nd level comments
                foreach ($v['child'] as $k => $v) {
                    $return[] = $v;
                    if(isset($v['child'])){  // If there are 3rd level comments
                        foreach ($v['child'] as $k => $v) {
                            $return[] = $v;
                        }
                    }
                }
            }
        }
        return $return;
    }

    static function add_like($id_user,$id_discussion){

    }

    static function add_dislike($id_user,$id_discussion){

    }
}