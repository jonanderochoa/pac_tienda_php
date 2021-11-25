<?php

class CategoryController
{

    public function loadSelect($categoryId)
    {
        $categories = CategoryModel::getAll();
        foreach ($categories as $category) {
            if($categoryId == $category->CategoryID){
                echo "<option selected='selected' value='" . $category->CategoryID . "'>" . $category->Name . "</option>";
            }else {
                echo "<option value='" . $category->CategoryID . "'>" . $category->Name . "</option>";
            }
            
        }
    }
}
