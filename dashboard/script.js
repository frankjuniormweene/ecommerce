// Mock data for demonstration
const mockOrders = [
    {
        order_id: 1001,
        customer_id: 1,
        total_amount: 125.50,
        payment_method: 'MTN',
        order_status: 'completed',
        created_at: '2025-04-05 10:30:00',
        products: [
            { name: 'Wireless Headphones', quantity: 1, price: 75.00 },
            { name: 'Phone Case', quantity: 2, price: 25.25 }
        ]
    },
    {
        order_id: 1002,
        customer_id: 1,
        total_amount: 89.99,
        payment_method: 'Airtel',
        order_status: 'pending',
        created_at: '2025-04-06 14:45:00',
        products: [
            { name: 'Smart Watch', quantity: 1, price: 89.99 }
        ]
    },
    {
        order_id: 1003,
        customer_id: 1,
        total_amount: 45.75,
        payment_method: 'Zamtel',
        order_status: 'canceled',
        created_at: '2025-03-28 09:15:00',
        products: [
            { name: 'Bluetooth Speaker', quantity: 1, price: 45.75 }
        ]
    }
];

const mockProducts = [
    {
        product_id: 1,
        vendor_id: 2,
        name: 'Wireless Headphones',
        description: 'High-quality wireless headphones with noise cancellation and 30-hour battery life.',
        price: 75.00,
        created_at: '2025-03-15 08:00:00',
        updated_at: '2025-03-15 08:00:00',
        rating: 4.5
    },
    {
        product_id: 2,
        vendor_id: 3,
        name: 'Smart Watch',
        description: 'Fitness tracker with heart rate monitor, GPS, and waterproof design.',
        price: 89.99,
        created_at: '2025-03-20 10:30:00',
        updated_at: '2025-03-20 10:30:00',
        rating: 4.2
    },
    {
        product_id: 3,
        vendor_id: 2,
        name: 'Bluetooth Speaker',
        description: 'Portable Bluetooth speaker with 20W output and 15-hour playtime.',
        price: 45.75,
        created_at: '2025-03-10 14:15:00',
        updated_at: '2025-03-10 14:15:00',
        rating: 3.8
    },
    {
        product_id: 4,
        vendor_id: 4,
        name: 'Phone Case',
        description: 'Durable phone case with shock absorption and slim design.',
        price: 25.25,
        created_at: '2025-03-05 11:45:00',
        updated_at: '2025-03-05 11:45:00',
        rating: 4.0
    },
    {
        product_id: 5,
        vendor_id: 3,
        name: 'Wireless Charger',
        description: 'Fast wireless charger compatible with all Qi-enabled devices.',
        price: 35.50,
        created_at: '2025-03-25 09:30:00',
        updated_at: '2025-03-25 09:30:00',
        rating: 4.7
    },
    {
        product_id: 6,
        vendor_id: 2,
        name: 'Laptop Backpack',
        description: 'Ergonomic backpack with USB charging port and anti-theft design.',
        price: 55.00,
        created_at: '2025-03-18 13:20:00',
        updated_at: '2025-03-18 13:20:00',
        rating: 4.3
    }
];

const mockRatings = [
    {
        rating_id: 1,
        rater_id: 1,
        rated_id: 2,
        rating: 4,
        comment: 'Great product! The headphones work perfectly and the sound quality is excellent.',
        created_at: '2025-04-06 11:20:00',
        vendor_name: 'Tech Gadgets'
    },
    {
        rating_id: 2,
        rater_id: 1,
        rated_id: 3,
        rating: 3,
        comment: 'The watch is good but the battery life could be better.',
        created_at: '2025-04-02 16:45:00',
        vendor_name: 'Smart Devices'
    }
];

const mockUser = {
    user_id: 1,
    username: 'johndoe',
    role: 'customer',
    created_at: '2025-01-15 10:00:00',
    updated_at: '2025-04-01 14:30:00'
};

// DOM Elements
const ordersTable = document.getElementById('orders-table').getElementsByTagName('tbody')[0];
const productsGrid = document.getElementById('products-grid');
const ratingsList = document.getElementById('ratings-list');
const totalOrdersElement = document.getElementById('total-orders');
const completedOrdersElement = document.getElementById('completed-orders');
const canceledOrdersElement = document.getElementById('canceled-orders');
const pendingOrdersElement = document.getElementById('pending-orders');
const profileUsername = document.getElementById('profile-username');
const memberSince = document.getElementById('member-since');
const orderModal = document.getElementById('order-modal');
const productModal = document.getElementById('product-modal');
const orderDetails = document.getElementById('order-details');
const productDetails = document.getElementById('product-details');
const closeButtons = document.getElementsByClassName('close');
const logoutButton = document.getElementById('logout');

// Initialize the dashboard
document.addEventListener('DOMContentLoaded', function() {
    // Load orders
    loadOrders();
    
    // Load products
    loadProducts();
    
    // Load ratings
    loadRatings();
    
    // Load user profile
    loadProfile();
    
    // Load statistics
    loadStatistics();
    
    // Set up event listeners
    setupEventListeners();
});

function loadOrders() {
    ordersTable.innerHTML = '';
    
    mockOrders.forEach(order => {
        const row = ordersTable.insertRow();
        
        const orderIdCell = row.insertCell(0);
        orderIdCell.textContent = order.order_id;
        
        const dateCell = row.insertCell(1);
        dateCell.textContent = formatDate(order.created_at);
        
        const amountCell = row.insertCell(2);
        amountCell.textContent = `ZMW ${order.total_amount.toFixed(2)}`;
        
        const paymentCell = row.insertCell(3);
        paymentCell.textContent = order.payment_method;
        
        const statusCell = row.insertCell(4);
        const statusSpan = document.createElement('span');
        statusSpan.className = `status ${order.order_status}`;
        statusSpan.textContent = order.order_status;
        statusCell.appendChild(statusSpan);
        
        const actionCell = row.insertCell(5);
        const viewButton = document.createElement('button');
        viewButton.className = 'action-btn view-btn';
        viewButton.textContent = 'View';
        viewButton.onclick = () => showOrderDetails(order);
        actionCell.appendChild(viewButton);
    });
}

function loadProducts() {
    productsGrid.innerHTML = '';
    
    mockProducts.forEach(product => {
        const productCard = document.createElement('div');
        productCard.className = 'product-card';
        productCard.onclick = () => showProductDetails(product);
        
        productCard.innerHTML = `
            <div class="product-img">
                <img src="https://via.placeholder.com/300x200?text=${encodeURIComponent(product.name)}" alt="${product.name}">
            </div>
            <div class="product-info">
                <h3>${product.name}</h3>
                <p>${product.description}</p>
                <div class="product-price">ZMW ${product.price.toFixed(2)}</div>
                <div class="product-rating">
                    ${generateStarRating(product.rating)}
                    <span>(${product.rating})</span>
                </div>
                <div class="product-actions">
                    <button class="add-to-cart">Add to Cart</button>
                    <button class="buy-now">Buy Now</button>
                </div>
            </div>
        `;
        
        productsGrid.appendChild(productCard);
    });
}

function loadRatings() {
    ratingsList.innerHTML = '';
    
    mockRatings.forEach(rating => {
        const ratingCard = document.createElement('div');
        ratingCard.className = 'rating-card';
        
        ratingCard.innerHTML = `
            <div class="rating-header">
                <div class="rated-user">
                    <img src="https://via.placeholder.com/40?text=${encodeURIComponent(rating.vendor_name.charAt(0))}" alt="${rating.vendor_name}">
                    <div class="rated-user-info">
                        <h4>${rating.vendor_name}</h4>
                        <p>Vendor</p>
                    </div>
                </div>
                <div class="rating-stars">
                    ${generateStarRating(rating.rating)}
                </div>
            </div>
            <div class="rating-comment">
                ${rating.comment}
            </div>
            <div class="rating-date">
                ${formatDate(rating.created_at)}
            </div>
        `;
        
        ratingsList.appendChild(ratingCard);
    });
}

function loadProfile() {
    profileUsername.textContent = mockUser.username;
    memberSince.textContent = formatDate(mockUser.created_at, true);
}

function loadStatistics() {
    const totalOrders = mockOrders.length;
    const completedOrders = mockOrders.filter(order => order.order_status === 'completed').length;
    const canceledOrders = mockOrders.filter(order => order.order_status === 'canceled').length;
    const pendingOrders = mockOrders.filter(order => order.order_status === 'pending').length;
    
    totalOrdersElement.textContent = totalOrders;
    completedOrdersElement.textContent = completedOrders;
    canceledOrdersElement.textContent = canceledOrders;
    pendingOrdersElement.textContent = pendingOrders;
}

function showOrderDetails(order) {
    orderDetails.innerHTML = `
        <div class="order-details-item">
            <h3>Order ID</h3>
            <p>${order.order_id}</p>
        </div>
        <div class="order-details-item">
            <h3>Order Date</h3>
            <p>${formatDate(order.created_at)}</p>
        </div>
        <div class="order-details-item">
            <h3>Total Amount</h3>
            <p>ZMW ${order.total_amount.toFixed(2)}</p>
        </div>
        <div class="order-details-item">
            <h3>Payment Method</h3>
            <p>${order.payment_method}</p>
        </div>
        <div class="order-details-item">
            <h3>Status</h3>
            <p><span class="status ${order.order_status}">${order.order_status}</span></p>
        </div>
        <div class="order-details-item">
            <h3>Products</h3>
            <ul>
                ${order.products.map(product => `
                    <li>${product.name} - ${product.quantity} x ZMW ${product.price.toFixed(2)}</li>
                `).join('')}
            </ul>
        </div>
    `;
    
    orderModal.style.display = 'block';
}

function showProductDetails(product) {
    productDetails.innerHTML = `
        <div class="product-details-img">
            <img src="https://via.placeholder.com/600x400?text=${encodeURIComponent(product.name)}" alt="${product.name}">
        </div>
        <div class="product-details-item">
            <h3>Product Name</h3>
            <p>${product.name}</p>
        </div>
        <div class="product-details-item">
            <h3>Description</h3>
            <p>${product.description}</p>
        </div>
        <div class="product-details-item">
            <h3>Price</h3>
            <p>ZMW ${product.price.toFixed(2)}</p>
        </div>
        <div class="product-details-item">
            <h3>Rating</h3>
            <p>${generateStarRating(product.rating)} (${product.rating})</p>
        </div>
    `;
    
    productModal.style.display = 'block';
}

function setupEventListeners() {
    // Close modals when clicking the X button
    for (