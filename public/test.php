<?php

declare(strict_types=1);

use Entity\Cover;

$cover = (Cover::findById(4)->getJpeg());
