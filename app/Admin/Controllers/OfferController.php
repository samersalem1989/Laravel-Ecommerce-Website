<?php

namespace App\Admin\Controllers;

use App\Models\Offer;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class OfferController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Offer';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Offer());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('discount', __('Discount'));
        $grid->column('details', __('Details'));
        $grid->column('image', __('Image'));
        $grid->column('section', __('Section'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Offer::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('discount', __('Discount'));
        $show->field('details', __('Details'));
        $show->field('image', __('Image'));
        $show->field('section', __('Section'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Offer());

        $form->text('title', __('Title'));
        $form->text('discount', __('Discount'));
        $form->text('details', __('Details'));
        $form->image('image', __('Image'));
        $form->image('section', __('Section'));

        return $form;
    }
}
