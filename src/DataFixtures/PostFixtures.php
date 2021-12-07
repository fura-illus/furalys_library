<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\Image;
use App\Entity\Video;
use App\Entity\Artist;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PostFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $artists = [
            'ヨシモト' => (new Artist())->setName('ヨシモト')->setAvatar('../../public/img/uploads/artists-avatar/@_acguy__pp.jpg'), 
            '久保田 正輝' => (new Artist())->setName('久保田 正輝')->setAvatar('../../public/img/uploads/artists-avatar/@_Kmasaki_pp.jpg'),
            'トリエット' => (new Artist())->setName('トリエット')->setAvatar('../../public/img/uploads/artists-avatar/@Tiamant_Torriet_pp.jpg'),
            'DuDuLtv' => (new Artist())->setName('DuDuLtv')->setAvatar('../../public/img/uploads/artists-avatar/@DuDuLtv_pp.jpg'),
            'sydsir' => (new Artist())->setName('sydsir')->setAvatar('../../public/img/uploads/artists-avatar/@sydsir_pp.jpg'),
            'dya rikku' => (new Artist())->setName('dya rikku')->setAvatar('../../public/img/uploads/artists-avatar/@dyarikku_pp.jpg')
        ];

        foreach($artists as $artist) {
            $manager->persist($artist);
        }


        $categories = [
            "Illustration" => [
                [
                    "image" => [
                        "@_acguy__FFLDsiMaAAAdCj8.png"
                    ],
                    "video" => [
                        ""
                    ],
                    "artist" => $artists["ヨシモト"]
                ],
                [
                    "image" => [
                        "@_Kmasaki_FFMJC9vagAArWA5.jfif"
                    ],
                    "video" => [
                        ""
                    ],
                    "artist" => $artists["久保田 正輝"]
                ],
                [
                    "image" => [
                        "@Tiamant_Torriet_FFBbW7maUAAh-iC.jfif"
                    ],
                    "video" => [
                        ""
                    ],
                    "artist" => $artists["トリエット"]
                ],
            ],
            "Live 2D rig" => [
                [
                    "image" => [
                        ""
                    ],
                    "video" => [
                        "https://drive.google.com/file/d/1WOjYc0hAGQJCFcMoNBjJxkf5kruddLMI/preview"
                    ],
                    "artist" => $artists["dya rikku"]
                ]
            ],
            "2D Animation" => [
                [
                    "image" => [
                        ""
                    ],
                    "video" => [
                        "https://drive.google.com/file/d/1VJSkMJ7Kjy7UJ5UTZp2lR42rcPe0rB76/preview"
                    ],
                    "artist" => $artists["DuDuLtv"]
                ],
                [
                    "image" => [
                        ""
                    ],
                    "video" => [
                        "https://drive.google.com/file/d/19XSiOskwkFDanNv6zDlzMfxoZnfiMalN/preview"
                    ],
                    "artist" => $artists["sydsir"]
                ]
            ],
            "Vtuber brain" => [
                [
                    "image" => [
                        ""
                    ],
                    "video" => [
                        "https://drive.google.com/file/d/1BHjkhK1H5qT97TfStj6JhYoO-GspMPyB/preview"
                    ],
                    "artist" => $artists["dya rikku"]
                ]
            ],
        ];

        foreach ($categories as $categoryName => $posts) {
            $category = new Category();
            $category->setName($categoryName);

            $manager->persist($category);

            foreach ($posts as $postData) {
                $post = new Post();
                $post->setArtist($postData['artist'])
                ->setAddedAt(new \DateTimeImmutable())
                ->setCategory($category);

                foreach ($postData["image"] as $imageData) {
                    $image = new Image();
                    $image->setPath($imageData);
                    $post->addImage($image);

                    $manager->persist($image);
                }
                foreach ($postData["video"] as $videoData) {
                    $video = new Video();
                    $video->setUrl($videoData);
                    $urlVideo = $video->getUrl();
                    $ytUrl = "https://www.youtube.com/embed/";
                    if (preg_match("#youtube#", $urlVideo)) {
                        // regex to isolate a youtube url' id specifically
                        preg_match('#https:\/\/www\.youtube\.com\/watch\?v=(.+)#', $urlVideo, $matches);
                        $ytId = $matches[1];
                        // adding embed url to isolate id
                        $ytUrlVideo = $ytUrl . $ytId;
                        $video->setUrl($ytUrlVideo);
                    } elseif (preg_match("#google#", $urlVideo)) {
                        $video->setUrl($urlVideo);
                    }
                    $post->addVideo($video);

                    $manager->persist($video);
                }
                $manager->persist($post);
            }
        }
        $manager->flush();
    }
}
