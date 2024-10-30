// document.addEventListener('close-modal', () => {
// //////////////////////categories //////////////////////
// // Close Edit Modal
// const editCategoryModal = document.getElementById('editCategory');
// const editCategoryInstance = bootstrap.Modal.getInstance(editCategoryModal);
// if (editCategoryInstance) {
// editCategoryInstance.hide();
// }

// // Close Delete Modal
// const deleteCategoryModal = document.getElementById('deleteCategory');
// const deleteCategoryInstance = bootstrap.Modal.getInstance(deleteCategoryModal);
// if (deleteCategoryInstance) {
// deleteCategoryInstance.hide();
// }

// // Close Create Modal if needed
// const addCategoryModal = document.getElementById('AddCategory');
// const addCategoryInstance = bootstrap.Modal.getInstance(addCategoryModal);
// if (addCategoryInstance) {
// addCategoryInstance.hide();
// }

// //////////////////////products //////////////////////
// // Close Edit Modal
// const editProductModal = document.getElementById('editProduct');
// const editProductInstance = bootstrap.Modal.getInstance(editProductModal);
// if (editProductInstance) {
// editProductInstance.hide();
// }

// // Close Delete Modal
// const deleteProductModal = document.getElementById('deleteProduct');
// const deleteProductInstance = bootstrap.Modal.getInstance(deleteProductModal);
// if (deleteProductInstance) {
// deleteProductInstance.hide();
// }

// // Close Create Modal if needed
// const addProductModal = document.getElementById('AddProduct');
// const addProductInstance = bootstrap.Modal.getInstance(addProductModal);
// if (addProductInstance) {
// addProductInstance.hide();
// }
// // Close Stock Modal if needed
// const editStockModal = document.getElementById('editStock');
// const editStockInstance = bootstrap.Modal.getInstance(editStockModal);
// if (editStockInstance) {
// editStockInstance.hide();
// }
// // Close delete from cart Modal if needed
// const deleteItemModal = document.getElementById('deleteItem');
// const deleteItemInstance = bootstrap.Modal.getInstance(deleteItemModal);
// if (deleteItemInstance) {
// deleteItemInstance.hide();
// }
// //////////////////////coupons //////////////////////
// // Close Edit Modal
// const editcouponsModal = document.getElementById('editCoupon');
// const editcouponsInstance = bootstrap.Modal.getInstance(editcouponsModal);
// if (editcouponsInstance) {
// editcouponsInstance.hide();
// }

// // Close Delete Modal
// const deletecouponsModal = document.getElementById('deleteCoupon');
// const deletecouponsInstance = bootstrap.Modal.getInstance(deletecouponsModal);
// if (deletecouponsInstance) {
// deletecouponsInstance.hide();
// }

// // Close Create Modal if needed
// const addcouponsModal = document.getElementById('AddCoupon');
// const addcouponsInstance = bootstrap.Modal.getInstance(addcouponsModal);
// if (addcouponsInstance) {
// addcouponsInstance.hide();
// }
// //////////////////////orders //////////////////////


// // Remove backdrop and class if necessary
// const modalBackdrop = document.querySelector('.modal-backdrop');
// if (modalBackdrop) {
// modalBackdrop.remove();
// }
// document.body.classList.remove('modal-open');
// });

// var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
// var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
// return new bootstrap.Dropdown(dropdownToggleEl)
// })
document.addEventListener('close-modal', () => {
    // Helper function to close a modal by ID
    const closeModalById = (modalId) => {
        const modalElement = document.getElementById(modalId);
        const modalInstance = bootstrap.Modal.getInstance(modalElement);
        if (modalInstance) {
            modalInstance.hide();
        }
    };

    // Close Category Modals
    closeModalById('editCategory');
    closeModalById('deleteCategory');
    closeModalById('AddCategory');

    // Close Product Modals
    closeModalById('editProduct');
    closeModalById('deleteProduct');
    closeModalById('AddProduct');
    closeModalById('editStock');
    closeModalById('deleteItem');

    // Close Coupon Modals
    closeModalById('editCoupon');
    closeModalById('deleteCoupon');
    closeModalById('AddCoupon');

    //  Order Modals (add more here as needed)
  closeModalById('completeOrder');


    // Remove backdrop and clear modal-open class from body
    const modalBackdrop = document.querySelector('.modal-backdrop');
    if (modalBackdrop) {
        modalBackdrop.remove();
    }
    document.body.classList.remove('modal-open');
});

// Initialize all dropdowns
var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
    return new bootstrap.Dropdown(dropdownToggleEl);
});
