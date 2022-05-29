<?php
namespace App\ServiceLayer;

use App\Models\Reward;
use App\Models\Article;
use Illuminate\Support\Facades\DB;

class ArticleAcceptance {
    public static function processAcept($article_id) {
        $rollback = false;
        DB::beginTransaction();

        // Sección de aceptación
        $article = Article::find($article_id);
        
        if($article != null) {
            $article->acepted = 1;
            $article->save();
        } else {
            $rollback = true;
        }

        if(!$rollback) {
            // Sección de recompensa
            $reward = Reward::getCurrentReward($article->user->id);

            if($reward != null) {
                $reward->points += 5;
            } else {
                $reward = new Reward();

                if($article->user == 'author')
                    $reward->isModerator = 0;
                else
                    $reward->isModerator = 1;

                if($reward != null)
                    $reward->points += 5;
                else
                    $rollback = true;
            }

            if(!$rollback)
                $reward->save();
        }

        if ($rollback) {
            DB::rollBack();
            return false;
        }

        DB::commit();
        return true;
    }
}