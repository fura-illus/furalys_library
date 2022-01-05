<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\Image;
use App\Entity\Video;
use App\Entity\Artist;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;

class PostFixtures extends Fixture
{
    protected $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {
        $artists = [
            'ヨシモト' => (new Artist())->setName('ヨシモト')
                                    ->setAvatar('img/uploads/artists-avatar/@_acguy__pp.jpg')
                                    ->setDescription('')
                                    ->setLink('https://twitter.com/_acguy_'), 
            '久保田 正輝' => (new Artist())->setName('久保田 正輝')
                                    ->setAvatar('img/uploads/artists-avatar/@_Kmasaki_pp.jpg')
                                    ->setDescription('Illustrator | イラストレーター
                                    ▼V娘
                                    (
                                    @Honoka_Himura
                                    ) (
                                    @cherry_osaki
                                    )
                                    ▼ポートフォリオ
                                    http://masakiillust.tumblr.com
                                    ▼お仕事のご依頼
                                    http://twpf.jp/_Kmasakiを確認の上メールもしくはDMまでお願いします。')
                                    ->setLink('https://twitter.com/_Kmasaki'),
            'トリエット' => (new Artist())->setName('トリエット')
                                    ->setAvatar('img/uploads/artists-avatar/@Tiamant_Torriet_pp.jpg')
                                    ->setDescription('Symbole emailLandauce4@gmail.com
                                    Cœur violetFANBOX : http://tiamant-torriet.fanbox.cc
                                    OC : ハリ(Hari Priite)')
                                    ->setLink('https://twitter.com/Tiamant_Torriet'),
            'DuDuLtv' => (new Artist())->setName('DuDuLtv')
                                    ->setAvatar('img/uploads/artists-avatar/@DuDuLtv_pp.jpg')
                                    ->setDescription('Artist / Animator | アニメーター')
                                    ->setLink('https://twitter.com/DuDuLtv'),
            'sydsir' => (new Artist())->setName('sydsir')
                                    ->setAvatar('img/uploads/artists-avatar/@sydsir_pp.jpg')
                                    ->setDescription('i disappeared for like 4 yrs so understandably i am not a person but a concept Drapeau de la ChineDrapeau du Canada 
                                    she/her | currently @ n*tflix animation')
                                    ->setLink('https://twitter.com/sydsir'),
            'dya rikku' => (new Artist())->setName('dya rikku')
                                    ->setAvatar('img/uploads/artists-avatar/@dyarikku_pp.jpg')
                                    ->setDescription('VT - 000 ɢʟɪᴛᴄʜᴇᴅ 2ᴅ ᴀʀᴛɪꜱᴛ, ʟ2ᴅ ʀɪɢɢᴇʀ ᴀɴᴅ ᴠᴛᴜʙᴇʀ. @twitch ᴀɴᴅ @discord ᴘᴀʀᴛɴᴇʀ. 
                                    #dyartikku #rikkuhands ᴄᴏᴍᴍɪꜱꜱɪᴏɴꜱ ᴄʟᴏꜱᴇᴅ http://dyarikku.com')
                                    ->setLink('https://twitter.com/dyarikku')
        ];

        foreach($artists as $artist) {
            $artist->setSlug($this->slugger->slug($artist->getName())->lower()->toString());
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
