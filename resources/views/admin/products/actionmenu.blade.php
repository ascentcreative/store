@extends('cms::admin.ui.index.actionmenucolumn')
    
@section('action-menu-buttons')

    <a href="{{ route('admin.store.products.addstock', ['product'=>$item] ) }}" class="dropdown-item text-sm modal-link">Add Stock</a>
    
    <div class="dropdown-divider"></div>
    
    @include('cms::admin.ui.index.deletebutton')

@overwrite