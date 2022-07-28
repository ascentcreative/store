<x-forms-modal :form="(new AscentCreative\Store\Forms\Admin\Modal\AddStock())->populate(['stockable_type'=>get_class($product), 'stockable_id'=>$product->id])"
        title="Add Stock" size="modal-md"
    />