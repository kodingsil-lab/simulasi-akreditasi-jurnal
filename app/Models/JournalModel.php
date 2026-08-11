<?php

namespace App\Models;

use CodeIgniter\Model;

class JournalModel extends Model
{
    protected $table            = 'journals';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useTimestamps    = true;
    protected $allowedFields    = ['name', 'slug', 'e_issn', 'website_url', 'publisher', 'scope', 'frequency', 'first_published_year', 'doi_prefix', 'is_active'];
}
