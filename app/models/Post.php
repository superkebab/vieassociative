<?php
class Post extends Eloquent
{
    static function get($idPost,$idAuthor){
        return elo_PropositionPost::where('id_author',$idAuthor)
                    ->where('id_post',$idPost)->first();
    }
    static function listNews($idAssoc){
        $posts = elo_Post::where('id_association',$idAssoc)->get();
        foreach ($posts as $k => $v) {
            $posts[$k]->propositionPost = $v->propositionPost()->first();
        }
        return $posts;
    }

    static function countNews($idAssoc){
        return elo_Post::where('id_association',$idAssoc)->count();
    }

    static function addNews($idAssoc,$idUser){
        $post = new elo_Post;
        $post->active = 0;
        $post->id_association = $idAssoc;
        $post->id_proposition_post = "null";
        $post->touch();


        $proposition_post = new elo_PropositionPost;
        $proposition_post->id_post = $post->id;
        $proposition_post->id_author = $idUser;
        $proposition_post->touch();

        return $post->id;
    }

    static function addProposition($idPost,$idAuthor,$data){
        $proposition_post = elo_PropositionPost::where('id_author',$idAuthor)
                            ->where('id_post',$idPost)
                            ->update(
                                array(
                                    'title' => $data['title'],
                                    'content' => $data['text'],
                                    'wish_time_publish' => $data['wish_time_publish'].' 00:00:00',
                                )
                            );
    }
}