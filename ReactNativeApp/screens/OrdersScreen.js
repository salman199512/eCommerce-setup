import React from 'react';
import { View, Text, ScrollView, TouchableOpacity, StyleSheet } from 'react-native';
import { orders } from '../data/shopData';

export default function OrdersScreen() {
  return (
    <ScrollView style={styles.container} contentContainerStyle={styles.content}>
      <Text style={styles.title}>My Orders</Text>
      <Text style={styles.subtitle}>Track and manage your purchases</Text>

      {orders.map(order => (
        <TouchableOpacity key={order.id} style={styles.orderCard}>
          <View style={styles.orderHeader}>
            <View>
              <Text style={styles.orderNumber}>Order #{order.id}</Text>
              <Text style={styles.orderDate}>{order.date}</Text>
            </View>
            <View style={[styles.statusBadge, { backgroundColor: order.status === 'Delivered' ? '#dcfce7' : '#fef3c7' }]}>
              <Text style={[styles.statusText, { color: order.status === 'Delivered' ? '#15803d' : '#b45309' }]}>
                {order.status}
              </Text>
            </View>
          </View>

          <View style={styles.orderDetails}>
            <Text style={styles.detailLabel}>Items</Text>
            <Text style={styles.detailValue}>{order.items} items</Text>
          </View>

          <View style={styles.orderFooter}>
            <View>
              <Text style={styles.totalLabel}>Total</Text>
              <Text style={styles.totalAmount}>₹{order.total}</Text>
            </View>
            <TouchableOpacity style={styles.viewButton}>
              <Text style={styles.viewButtonText}>View Details</Text>
            </TouchableOpacity>
          </View>
        </TouchableOpacity>
      ))}
    </ScrollView>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: '#fafaf9' },
  content: { padding: 16, paddingBottom: 48 },
  title: { fontSize: 28, fontWeight: '800', color: '#111827', marginBottom: 6 },
  subtitle: { fontSize: 15, color: '#6b7280', marginBottom: 24 },
  orderCard: {
    backgroundColor: '#ffffff',
    borderRadius: 20,
    padding: 18,
    marginBottom: 14,
    borderWidth: 1,
    borderColor: '#f3f4f6',
  },
  orderHeader: { flexDirection: 'row', justifyContent: 'space-between', alignItems: 'flex-start', marginBottom: 16 },
  orderNumber: { fontSize: 16, fontWeight: '800', color: '#111827' },
  orderDate: { fontSize: 13, color: '#6b7280', marginTop: 4 },
  statusBadge: { paddingHorizontal: 12, paddingVertical: 6, borderRadius: 12 },
  statusText: { fontSize: 12, fontWeight: '700' },
  orderDetails: { borderTopWidth: 1, borderTopColor: '#f3f4f6', paddingTop: 12, marginBottom: 12 },
  detailLabel: { fontSize: 12, color: '#6b7280', fontWeight: '600' },
  detailValue: { fontSize: 14, fontWeight: '700', color: '#111827', marginTop: 4 },
  orderFooter: { flexDirection: 'row', justifyContent: 'space-between', alignItems: 'center' },
  totalLabel: { fontSize: 12, color: '#6b7280', fontWeight: '600' },
  totalAmount: { fontSize: 18, fontWeight: '800', color: '#f59e0b', marginTop: 4 },
  viewButton: { paddingHorizontal: 16, paddingVertical: 10, backgroundColor: '#fef3c7', borderRadius: 10 },
  viewButtonText: { fontSize: 13, fontWeight: '700', color: '#b45309' },
});
