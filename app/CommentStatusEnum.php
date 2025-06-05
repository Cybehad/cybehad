<?php

namespace App;

enum CommentStatusEnum: string
{
    case Approved = 'approved';
    case Pending = 'pending';
    case Spam = 'spam';
}
