<?php

namespace App\Models;

use CodeIgniter\Model;

class JournalAdminModel extends Model
{
    protected $table         = 'journal_admins';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['journal_id', 'user_id'];
}
