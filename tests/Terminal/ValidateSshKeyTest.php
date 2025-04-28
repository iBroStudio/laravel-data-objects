<?php

use IBroStudio\DataObjects\Terminal\ValidateSshKey;
use Illuminate\Support\Facades\File;

it('can validate a valid ssh key', function (string $key) {
    $validate = new ValidateSshKey($key);

    expect($validate())->toBeTruthy()
        ->and(
            File::allFiles(storage_path('ssh'))
        )->toBeEmpty();
})->with([
    'RSA' => 'ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABgQD3vYKSuh7rJf+NtWn04CFyT9+nmx+i+/sP+yMN9ueJ+Rd5Ku6d9kgscK2xwlRlkcA0sethslu0WUsG81RC1lVpF6iLrc/9O45ZhEY1CB/7dofr+7ZNwu/DJtbW6YE7oyT5G97BUW763TMq/YO9/xjMToetElTEJ4hUVWdP8q93b3MVHBazk2PEuS05wzP4p5XeQnhKq4LISetJFEgI8Y+HEpK29GiU/18fhaGZvdVwOToOxTwEwBbS3fTLNkBaUTWw9q3i7S60RRncBCHppcs2irrzw7yt7ZQOnut/BIjIGESoxx+N4ZrpTmX6P5d3/9Duk40Mfwh1ftsvze6o5AW4Xi0tki8b6bsMXmO7SapqVdiMZ5/4BWOkqHWhi926qz7I9NWoZuVFAUpSoe6fObzQBRooVp7ARw7gJ4C+Q4xc1gJJkZoQ/Wj/wHkVnbLw9M5+t5GjyWgDDOr5iyoGOyIwhuEFvATzIYH0z5B6anL1n6XQmeGh5OWKJN8wE5qVNTU= worker@envoyer.io',
    'EDCSA' => 'ecdsa-sha2-nistp256 AAAAE2VjZHNhLXNoYTItbmlzdHAyNTYAAAAIbmlzdHAyNTYAAABBBFvXWSVYzRnjxYsz/xKjOjAaPjzg98MMHaDulQYczTX28xlsMmFkviCeCCv7CLh19ydoH4LNKpvgTGiMXz8ib68= worker@envoyer.',
]);

it('can not validate an invalid ssh key', function () {
    $validate = new ValidateSshKey('a simple text file');

    expect($validate())->toBeFalsy()
        ->and(
            File::allFiles(storage_path('ssh'))
        )->toBeEmpty();
});
