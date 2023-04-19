<?php

namespace Melisearch\Services;
use MeiliSearch\Client;
class MelisearchService
{
    public function setClientMelisearch() {
        $url = config('melisearch.url');
        $setClient = new Client($url, config('melisearch.pass'));
        return $setClient;
    }
    public function createOrUpdate($array = [], $table = '') {
        $client = $this->setClientMelisearch();
        $index = $client->index($table);
        $index->addDocuments($array);
    }
    public function delete($id = 0, $table = '') {
        $client = $this->setClientMelisearch();
        $client->index($table)->deleteDocument($id);
        return true;
    }

}
