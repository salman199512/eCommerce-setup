export const categories = [
  { id: '1', name: 'Fashion', icon: '👗', items: 124 },
  { id: '2', name: 'Electronics', icon: '🔌', items: 88 },
  { id: '3', name: 'Home', icon: '🏠', items: 72 },
  { id: '4', name: 'Beauty', icon: '💄', items: 54 },
];

export const featuredProducts = [
  {
    id: 'p1',
    name: 'Classic Leather Bag',
    category: 'Fashion',
    price: 79.99,
    tagline: 'A modern everyday companion.',
    description: 'Premium leather craftsmanship with a lightweight structure, perfect for daily use and travel.',
    rating: 4.8,
    image: 'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 'p2',
    name: 'Wireless Earbuds',
    category: 'Electronics',
    price: 59.99,
    tagline: 'Clear sound for every moment.',
    description: 'Compact earbuds with noise isolation and long battery life to keep your music flowing all day.',
    rating: 4.7,
    image: 'https://images.unsplash.com/photo-1512499617640-c2f9992c17c2?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 'p3',
    name: 'Minimal Desk Lamp',
    category: 'Home',
    price: 34.99,
    tagline: 'Soft light for focused work.',
    description: 'Sleek lamp with adjustable angles and warm LED illumination for office and bedroom.',
    rating: 4.9,
    image: 'https://images.unsplash.com/photo-1524758631624-e2822e304c36?auto=format&fit=crop&w=800&q=80'
  },
];

export const bestSellers = [
  {
    id: 'p4',
    name: 'Everyday Hoodie',
    category: 'Fashion',
    price: 49.99,
    description: 'Soft cotton hoodie with a modern fit for casual comfort.',
    rating: 4.7,
    image: 'https://images.unsplash.com/photo-1520880867055-1e30d1cb001c?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 'p5',
    name: 'Smartwatch',
    category: 'Electronics',
    price: 129.99,
    description: 'Track fitness, messages, and notifications with polished convenience.',
    rating: 4.5,
    image: 'https://images.unsplash.com/photo-1517430816045-df4b7de1d1ba?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 'p6',
    name: 'Cozy Throw Blanket',
    category: 'Home',
    price: 24.99,
    description: 'Soft woven blanket for couch evenings and relaxing weekends.',
    rating: 4.9,
    image: 'https://images.unsplash.com/photo-1519710164239-da123dc03ef4?auto=format&fit=crop&w=800&q=80'
  },
];

export const cartItems = [
  { id: 'p4', name: 'Everyday Hoodie', category: 'Fashion', price: 49.99, quantity: 1 },
  { id: 'p2', name: 'Wireless Earbuds', category: 'Electronics', price: 59.99, quantity: 2 },
];

export const orders = [
  {
    id: 'ORD-2024-001',
    date: 'April 3, 2026',
    status: 'Delivered',
    items: 3,
    total: '234.99',
  },
  {
    id: 'ORD-2024-002',
    date: 'March 28, 2026',
    status: 'In Transit',
    items: 1,
    total: '79.99',
  },
  {
    id: 'ORD-2024-003',
    date: 'March 15, 2026',
    status: 'Delivered',
    items: 2,
    total: '145.98',
  },
];

export const wishlistItems = [
  {
    id: 'w1',
    name: 'Premium Designer Bag',
    category: 'Fashion',
    price: 199.99,
    image: 'https://images.unsplash.com/photo-1548036328-c9fa89d128fa?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 'w2',
    name: 'Wireless Headphones',
    category: 'Electronics',
    price: 149.99,
    image: 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 'w3',
    name: 'Luxury Watch',
    category: 'Accessories',
    price: 299.99,
    image: 'https://images.unsplash.com/photo-1523170535258-f5ed11844a49?auto=format&fit=crop&w=800&q=80'
  },
];

export const notifications = [
  {
    id: 1,
    icon: '📦',
    title: 'Order Delivered',
    message: 'Your order #ORD-2024-001 has been delivered successfully.',
    time: '2 hours ago',
    read: true,
  },
  {
    id: 2,
    icon: '🎉',
    title: 'Special Offer',
    message: 'Get 20% off on your next purchase. Use code LUXURA20',
    time: '5 hours ago',
    read: false,
  },
  {
    id: 3,
    icon: '✅',
    title: 'Payment Successful',
    message: 'Payment of ₹234.99 has been processed successfully.',
    time: '1 day ago',
    read: true,
  },
  {
    id: 4,
    icon: '🚚',
    title: 'Shipment on the way',
    message: 'Your order #ORD-2024-002 is on its way to you.',
    time: '2 days ago',
    read: true,
  },
];
