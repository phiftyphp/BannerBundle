<?php
namespace BannerSlider\Model;



class ImageCollection 
extends \BannerSlider\Model\ImageCollectionBase
{
    public $defaultOrdering = array(
        array('ordering','asc'),
        array('id','asc'),
    );

    /**
     * $images = ImageCollection::by_placeholder('index');
     */
    public static function by_placeholder($identity)
    {
        $c = new Category( array('place_holder' => $identity, 'lang' => kernel()->locale->current() ) );
        if ( ! $c->id ) {
            return;
        }
        $collection = new self;
        $collection->where()
            ->equal('category_id',$c->id);
        return $collection;
    }
    
}
