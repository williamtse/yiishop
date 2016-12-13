<?php
namespace backend\helpers;

class Score
{
    public function show($score=0)
    {
        $hafstar = $score/0.5;
        if(!$star = $hafstar%2)
        {
            while($star>0)
            {
                echo '<div class="star star-full"></div>';
                $star--;
            }
        }else{
            $star = ($hafstar-1)/2;
            while($star>0)
            {
                echo '<div class="star star-full"></div>';
                $star--;
            }
            echo '<div class="star star-half"></div>';
        }
    }
}

