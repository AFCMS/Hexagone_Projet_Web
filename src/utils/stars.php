<?php

function starsHTML(float $rating): string
{
    $fullStars = floor($rating);
    $halfStar = ($rating - $fullStars) >= 0.5 ? 1 : 0;
    $emptyStars = 5 - $fullStars - $halfStar;
    $starsStr = str_repeat('★', $fullStars) . ($halfStar ? '⯪' : '') . str_repeat('☆', $emptyStars);
    return <<<HTML
    <div class="stars">
        {$starsStr}
    </div>
HTML;
}