<?php

declare(strict_types=1);

use Entity\Cover;
use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;

try {
    if (!isset($_GET['coverId']) || !ctype_digit(intval($_GET['coverId']))) {
        throw new ParameterException('Paramètre "coverId" manquant ou de mauvais type');
    }

    $cover = Cover::findById(intval($_GET['coverId']))->getJpeg();
    header('Content-Type: image/jpeg');
    echo $cover;
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
