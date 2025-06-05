<?php

namespace App;

enum ScheduledPostStatusEnum: string
{
    case Pending = 'pending';
    case Published = 'published';
    case Canceled = 'canceled';
}
