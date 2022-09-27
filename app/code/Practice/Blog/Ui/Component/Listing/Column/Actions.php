<?php

namespace Practice\Blog\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;



class Actions extends Column
{
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {

            foreach ($dataSource['data']['items'] as & $item) {
                $blogId = $item['blog_entity_id'];
                // var_dump($blogId);
                // die();

                $item[$this->getData('name')] = [
                    'edit' => [
                        'href' => '/admin/blog/post/edit/id/'.$blogId,
                        'label' => __('Edit')
                    ],

                    'show' => [
                        'href' => '/admin/blog/post/show/id/'.$blogId,
                        'label' => __('Show')
                    ],
                ];
            }
        }

        return $dataSource;
    }
}
