<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class PermissionName extends Enum
{
    const CREATE_STORE = 'create-store';
    const EDIT_STORE = 'edit-store';
    const DELETE_STORE = 'delete-store';
    const RESTORE_STORE = 'restore-store';

    const CREATE_CATEGORY = 'create-category';
    const EDIT_CATEGORY = 'edit-category';
    const SHOW_CATEGORY = 'show-category';
    const SHOW_ALL_CATEGORY = 'show-all-category';
    const SHOW_CATEGORY_PRODUCTS = 'show-category-products';
    const DELETE_CATEGORY = 'delete-category';
    const RESTORE_CATEGORY = 'restore-category';

    const CREATE_ATTRIBUTE = 'create-attribute';
    const EDIT_ATTRIBUTE = 'edit-attribute';
    const SHOW_ATTRIBUTE = 'show-attribute';
    const SHOW_ALL_ATTRIBUTES = 'show-all-attributes';
    const DELETE_ATTRIBUTE = 'delete-attribute';
    const RESTORE_ATTRIBUTE = 'restore-attribute';

    const CREATE_PARAMETER = 'create-parameter';
    const EDIT_PARAMETER = 'edit-parameter';
    const SHOW_PARAMETER = 'show-parameter';
    const SHOW_ALL_PARAMETERS = 'show-all-parameters';
    const DELETE_PARAMETER = 'delete-parameter';
    const RESTORE_PARAMETER = 'restore-parameter';

    const CREATE_PRODUCT = 'create-product';
    const EDIT_PRODUCT = 'edit-product';
    const SHOW_PRODUCT = 'show-product';
    const SHOW_ALL_PRODUCTS = 'show-all-products';
    const DELETE_PRODUCT = 'delete-product';
    const RESTORE_PRODUCT = 'restore-product';

    const CREATE_ORDER = 'create-order';
    const EDIT_ORDER = 'edit-order';
    const SHOW_ALL_ORDERS = 'show-all-orders';
    const SHOW_ORDER = 'show-order';
    const DELETE_ORDER = 'delete-order';
    const RESTORE_ORDER = 'restore-order';

    const SHOW_ALL_USERS = 'show-all-users';
    const DELETE_USER = 'delete-user';
    const RESTORE_USER = 'restore-user';
}
