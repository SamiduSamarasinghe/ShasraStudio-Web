//Buy Now
document.addEventListener('DOMContentLoaded', () => {
  const urlParams = new URLSearchParams(window.location.search);
  const productId = urlParams.get('id');

  if (productId) {
      fetchProductDetails(productId);
  }

  const addToCartButton = document.getElementById('btn-add-cart');
  addToCartButton.addEventListener('click', () => {
      const quantity = parseInt(document.getElementById('quantity').value, 10);
      const productDetails = {
          id: productId,
          name: document.getElementById('product-name').innerText,
          price: document.getElementById('product-price').innerText,
          image_url: document.getElementById('product-img').src,
          quantity: quantity
      };
      localStorage.setItem('selectedProduct', JSON.stringify(productDetails));
  });
});

const fetchProductDetails = (id) => {
  fetch(`product.php?id=${id}`)
      .then(response => response.json())
      .then(data => {
          if (data.error) {
              alert('Product not found');
              return;
          }
          displayProductDetails(data);
      });
};

const displayProductDetails = (product) => {
  const { name, description, price, category, image_url } = product;
  document.getElementById('product-name').innerText = name;
  document.getElementById('product-description').innerText = description;
  document.getElementById('product-price').innerText = `Rs.${price}`;
  document.getElementById('product-category').innerText = category;
  document.getElementById('product-img').src = image_url;

  // Additional images handling
  const smallImgRow = document.getElementById('small-img-row');
  smallImgRow.innerHTML = '';
  const smallImages = product.additional_images.split(',');
  smallImages.forEach(img => {
      const imgElement = document.createElement('img');
      imgElement.src = img;
      imgElement.width = 100;
      imgElement.classList.add('small-img');
      imgElement.addEventListener('click', () => {
          document.getElementById('product-img').src = img;
      });
      smallImgRow.appendChild(imgElement);
  });
};





