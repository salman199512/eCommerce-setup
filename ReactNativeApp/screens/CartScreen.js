import React from 'react';
import { View, Text, ScrollView, TouchableOpacity, StyleSheet } from 'react-native';
import { cartItems } from '../data/shopData';

export default function CartScreen() {
  const subtotal = cartItems.reduce((sum, item) => sum + item.price * item.quantity, 0);
  const delivery = 5.99;
  const total = subtotal + delivery;

  return (
    <ScrollView style={styles.container} contentContainerStyle={styles.content}>
      <Text style={styles.title}>My Cart</Text>
      <Text style={styles.subtitle}>Review your items before checkout.</Text>

      {cartItems.map(item => (
        <View key={item.id} style={styles.cartItem}>
          <View style={styles.textGroup}>
            <Text style={styles.itemName}>{item.name}</Text>
            <Text style={styles.itemMeta}>{item.category} • Qty {item.quantity}</Text>
          </View>
          <Text style={styles.itemPrice}>${(item.price * item.quantity).toFixed(2)}</Text>
        </View>
      ))}

      <View style={styles.summaryCard}>
        <View style={styles.summaryRow}>
          <Text style={styles.summaryLabel}>Subtotal</Text>
          <Text style={styles.summaryValue}>${subtotal.toFixed(2)}</Text>
        </View>
        <View style={styles.summaryRow}>
          <Text style={styles.summaryLabel}>Delivery</Text>
          <Text style={styles.summaryValue}>${delivery.toFixed(2)}</Text>
        </View>
        <View style={styles.divider} />
        <View style={styles.summaryRow}>
          <Text style={[styles.summaryLabel, styles.totalLabel]}>Total</Text>
          <Text style={[styles.summaryValue, styles.totalValue]}>${total.toFixed(2)}</Text>
        </View>
      </View>

      <TouchableOpacity style={styles.checkoutButton}>
        <Text style={styles.checkoutText}>Proceed to Checkout</Text>
      </TouchableOpacity>
    </ScrollView>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: '#fafaf9' },
  content: { padding: 16, paddingBottom: 48 },
  title: { fontSize: 28, fontWeight: '800', color: '#111827' },
  subtitle: { color: '#6b7280', marginVertical: 8, fontSize: 15 },
  cartItem: {
    backgroundColor: '#ffffff',
    borderRadius: 20,
    padding: 18,
    marginBottom: 14,
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    borderWidth: 1,
    borderColor: '#f3f4f6',
  },
  textGroup: { flex: 1, paddingRight: 12 },
  itemName: { fontSize: 16, fontWeight: '700', color: '#111827' },
  itemMeta: { color: '#6b7280', marginTop: 6 },
  itemPrice: { fontSize: 16, fontWeight: '700', color: '#f59e0b' },
  summaryCard: {
    backgroundColor: '#ffffff',
    borderRadius: 20,
    padding: 18,
    marginTop: 18,
    marginBottom: 24,
    borderWidth: 1,
    borderColor: '#f3f4f6',
  },
  summaryRow: { flexDirection: 'row', justifyContent: 'space-between', marginBottom: 12 },
  summaryLabel: { color: '#6b7280', fontSize: 15 },
  summaryValue: { color: '#111827', fontSize: 15, fontWeight: '700' },
  totalLabel: { color: '#111827' },
  totalValue: { fontSize: 18, color: '#f59e0b' },
  divider: { height: 1, backgroundColor: '#e5e7eb', marginVertical: 12 },
  checkoutButton: {
    height: 56,
    borderRadius: 16,
    backgroundColor: '#f59e0b',
    alignItems: 'center',
    justifyContent: 'center',
  },
  checkoutText: { color: '#ffffff', fontSize: 16, fontWeight: '700' },
});
