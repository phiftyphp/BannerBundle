<?php
namespace BannerBundle\Model;
use LazyRecord\Schema\SchemaDeclare;

class ImageSchema extends SchemaDeclare
{
    public $table = 'banner_images';

    function schema()
    {
        $this->column('image')
            ->varchar(256)
            ->contentType('ImageFile')
            ->label( _('大圖') );

        $this->column('thumb')
            ->varchar(256)
            ->contentType('ImageFile')
            ->label( _('縮圖') );

        $this->column('title')
            ->varchar(200)
            ->label( _('Title') )
            ->renderAs('TextInput',array( 'size' => 50 ))
            ->hint( _('可選輸入。若輸入可幫助搜尋引擎索引結果。') )
            ;

        $this->column('subtitle')
            ->varchar(512)
            ->label( _('Subtitle') )
            ->renderAs('TextInput',array( 'size' => 60 ))
            ->hint( _('可選輸入。若輸入可幫助搜尋引擎索引結果。') )
            ;

        $this->column('link')
            ->varchar(512)
            ->label( _('網址連結') )
            ->renderAs('TextInput',array( 'size' => 70, 'placeholder' => 'http://....' ))
            ->hint( _('點擊圖片時，打開的新網址') )
            ;

        $this->column('comment')
            ->text()
            ->label( _('註解') )
            ->renderAs('TextareaInput',array( 'rows' => 3, 'cols' => 50 ))
            ;

        $this->column('category_id')
            ->integer()
            ->refer('BannerBundle\\Model\\CategorySchema')
            ->renderAs('SelectInput', [ 'allow_empty' => true ])
            ->label( _('Banner 類別') );

        $this->mixin('SortablePlugin\\Model\\Mixin\\OrderingSchema');
        $this->mixin('CommonBundle\\Model\\Mixin\\MetaSchema');

        /** self accessor , ( foreign schema, column ) , self column ) **/
        $this->belongsTo('category', 'BannerBundle\\Model\\CategorySchema' , 'id' , 'category_id' );
    }
}

