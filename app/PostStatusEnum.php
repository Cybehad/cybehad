<?php

namespace App;

enum PostStatusEnum: string
{
    case Draft = 'draft';
    case Published = 'published';
    case Archieved = 'archived';
}
