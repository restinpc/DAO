<?php
/**
* Prints an image viewer and updates pictures inside article.
* @path /engine/core/function/print_image_viewer.php
*
* @name    DAO Mansion    @version 1.0.3
* @author  Aleksandr Vorkunov  <devbyzero@yandex.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*
* @var $site->title - Page title.
* @var $site->content - Page HTML data.
* @var $site->keywords - Array meta keywords.
* @var $site->description - Page meta description.
* @var $site->img - Page meta image.
* @var $site->onload - Page executable JavaScript code.
*
* @param object $site Site class object.
* @param string $text Text of article.
* @param string $caption Article name.
* @param array $images Array with images for rotation.
* @return string Returns content of article on success.
* @usage <code>
*   $text = 'Text of article. <img src="/img/1.jpg" /> <br/> <img src="/img/2.jpg" /> ';
*   $caption = 'Article name';
*   $images = array("/img/1.jpg", "/img/2.jpg");
*   $captions = array("Image 1", "Image 2");
*   engine::print_image_viewer($site, $text, $caption, $images, $captions);
* </code>
*/

function print_image_viewer($site, $text, $caption, $images, $captions) {
    $gallery = '';
    if (!empty($images)) {
        for ($i = 0; $i < count($images); $i++) {
            $image = $images[$i];
            $image = str_replace('../img', '/img', $image);
            $size = getimagesize($image);
            $text = str_replace($images[$i].'"', $image.'" id="viewer-image-'.$i.'" alt="'.$image.'" onClick=\'document.framework.nodesGallery("'.$image.'");\' class="img pointer"', $text);
            if (!$size[0]) {
                $size = getimagesize($_SERVER["PUBLIC_URL"].$image);
            }
            if ($size[0]) {
                if (!empty($captions[$i])) {
                    $title = $captions[$i];
                } else {
                    $title = $caption;
                }
                $gallery .= '<figure itemprop="associatedMedia" itemscope itemtype="https://schema.org/ImageObject">
                    <a id="image-'.$i.'" target="_blank" href="'.$image.'" itemprop="contentUrl" data-size="'.$size[0].'x'.$size[1].'">
                        <img id="nodes_gallery_'.$i.'" src="'.$image.'" itemprop="thumbnail" alt="'.$image.'" title="'.$title.'" />
                    </a>
                    <figcaption itemprop="caption description">'.$title.'</figcaption>
                </figure>';
            }
        }
    }
    if (!empty($gallery)) {
        $fout = $text.'
        <div id="nodes_gallery" class="nodes_gallery hidden" data-jssor-slider="1" itemscope itemtype="https://schema.org/ImageGallery">
            '.$gallery.'
        </div>
        <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="pswp__bg"></div>
            <div class="pswp__scroll-wrap">
                <div class="pswp__container">
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                </div>
                <div class="pswp__ui pswp__ui--hidden">
                    <div class="pswp__top-bar">
                        <div class="pswp__counter"></div>
                        <button id="pswp-button-close" class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                        <button id="pswp-button-fs" class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                        <button id="pswp-button-zoom" class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                        <div class="pswp__preloader">
                            <div class="pswp__preloader__icn">
                              <div class="pswp__preloader__cut">
                                <div class="pswp__preloader__donut"></div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                        <div class="pswp__share-tooltip"></div> 
                    </div>
                    <button id="pswp-button-prev" class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
                    </button>
                    <button id="pswp-button-next" class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
                    </button>
                    <div class="pswp__caption">
                        <div class="pswp__caption__center"></div>
                    </div>
                </div>
            </div>
        </div>';
        $site->onload .= '; document.framework.showRotator(".nodes_gallery"); ';
        return $fout;
    } else {
        return $text;
    }
}
