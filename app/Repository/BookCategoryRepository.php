<?php
// namespace Repository;
class BookCategoryRepository
{
    /**
     * @param Bookscategories $books_categories
     */
    public function __construct(Bookscategories $books_categories)
    {
        $this->book_cat = $books_categories;
    }
    /**
     * @return mixed
     */
    public function dispAllCategories()
    {
        return $this->book_cat->get();
    }
    /**
     * @param $book_id
     * @param $new_updated_cat_name
     * @return mixed
     */
    public function changeSingleBookDetail($book_id, $new_updated_cat_name)
    {
        $new_book_cat_name = $this->book_cat->find($book_id);
        $new_book_cat_name->categories = $new_updated_cat_name;
        return $new_book_cat_name->save();
    }
    /**
     * @param $new_category_name
     * @return mixed
     */
    public function addCategoryField($new_category_name)
    {
        $this->book_cat->categories = $new_category_name;
        return $this->book_cat->save();
    }
    /**
     * @param $category_name
     */
    public function browseWithCatRepo($category_name)
    {
        return Books::where('bookCategory', '=', $category_name)->get();
    }

}
