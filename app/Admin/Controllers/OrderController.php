<?php

namespace App\Admin\Controllers;

use App\Models\Order;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class OrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Order';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Order());

        $grid->column('id', __('Id'));
        $grid->column('SaleId', __('SaleId'));
        $grid->column('firstname', __('Firstname'));
        $grid->column('lastname', __('Lastname'));
        $grid->column('city', __('City'));
        $grid->column('email', __('Email'));
        $grid->column('address', __('Address'));
        $grid->column('TransactionAmount', __('TransactionAmount'));
        $grid->column('DocumentURL', __('DocumentURL'));
        $grid->column('SaleTime', __('SaleTime'));
        $grid->column('TransactionCardName', __('TransactionCardName'));
        $grid->column('TransactionCardNum', __('TransactionCardNum'));
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
        $show = new Show(Order::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('SaleId', __('SaleId'));
        $show->field('firstname', __('Firstname'));
        $show->field('lastname', __('Lastname'));
        $show->field('city', __('City'));
        $show->field('email', __('Email'));
        $show->field('address', __('Address'));
        $show->field('TransactionAmount', __('TransactionAmount'));
        $show->field('DocumentURL', __('DocumentURL'));
        $show->field('SaleTime', __('SaleTime'));
        $show->field('TransactionCardName', __('TransactionCardName'));
        $show->field('TransactionCardNum', __('TransactionCardNum'));
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
        $form = new Form(new Order());

        $form->text('SaleId', __('SaleId'));
        $form->text('firstname', __('Firstname'));
        $form->text('lastname', __('Lastname'));
        $form->text('city', __('City'));
        $form->email('email', __('Email'));
        $form->text('address', __('Address'));
        $form->text('TransactionAmount', __('TransactionAmount'));
        $form->text('DocumentURL', __('DocumentURL'));
        $form->text('SaleTime', __('SaleTime'));
        $form->text('TransactionCardName', __('TransactionCardName'));
        $form->text('TransactionCardNum', __('TransactionCardNum'));

        return $form;
    }
}
