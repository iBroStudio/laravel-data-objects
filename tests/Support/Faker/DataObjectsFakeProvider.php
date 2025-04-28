<?php

namespace IBroStudio\DataObjects\Tests\Support\Faker;

use Faker\Provider\Base;

class DataObjectsFakeProvider extends Base
{
    public function sshKey(): string
    {
        return 'ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTYAAAAIbmlzdHAyNTYAAABBBFvXWSVYzRnjxYsz/xKjOjAaPjzg98MMHaDulQYczTX28xlsMmFkviCeCCv7CLh19ydoH4LNKpvgTGiMXz8ib68= worker@envoyer.';
    }
}
