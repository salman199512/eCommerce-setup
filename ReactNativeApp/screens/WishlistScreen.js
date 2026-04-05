import React from 'react';
import { View, Text, ScrollView, TouchableOpacity, StyleSheet, Image } from 'react-native';
import { wishlistItems } from '../data/shopData';

export default function WishlistScreen() {
  return (
    <ScrollView style={styles.container} contentContainerStyle={styles.content}>
      <Text style={styles.title}>My Wishlist</Text>
      <Text style={styles.subtitle}>Items you love and want to save</Text>

      {wishlistItems.length > 0 ? (
        <View style={styles.grid}>
          {wishlistItems.map(item => (
            <TouchableOpacity key={item.id} style={styles.wishCard}>
              <View style={styles.imageWrapper}>
                <Image source={{ uri: item.image }} style={styles.image} />
                <TouchableOpacity style={styles.heartButton}>
                  <Text style={styles.heart}>❤️</Text>
                </TouchableOpacity>
              </View>
              <Text style={styles.itemName}>{item.name}</Text>
              <Text style={styles.itemCategory}>{item.category}</Text>
              <View style={styles.footer}>
                <Text style={styles.itemPrice}>₹{item.price}</Text>
                <TouchableOpacity style={styles.addButton}>
                  <Text style={styles.addButtonText}>+ Cart</Text>
                </TouchableOpacity>
              </View>
            </TouchableOpacity>
          ))}
        </View>
      ) : (
        <View style={styles.emptyState}>
          <Text style={styles.emptyEmoji}>💔</Text>
          <Text style={styles.emptyTitle}>Wishlist is Empty</Text>
          <Text style={styles.emptyText}>Start adding items you love</Text>
        </View>
      )}
    </ScrollView>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: '#fafaf9' },
  content: { padding: 16, paddingBottom: 48 },
  title: { fontSize: 28, fontWeight: '800', color: '#111827', marginBottom: 6 },
  subtitle: { fontSize: 15, color: '#6b7280', marginBottom: 24 },
  grid: { flexDirection: 'row', flexWrap: 'wrap', justifyContent: 'space-between' },
  wishCard: {
    width: '48%',
    backgroundColor: '#ffffff',
    borderRadius: 20,
    overflow: 'hidden',
    marginBottom: 16,
    borderWidth: 1,
    borderColor: '#f3f4f6',
  },
  imageWrapper: { position: 'relative', width: '100%', height: 180 },
  image: { width: '100%', height: '100%', resizeMode: 'cover' },
  heartButton: {
    position: 'absolute',
    top: 10,
    right: 10,
    width: 40,
    height: 40,
    backgroundColor: '#ffffff',
    borderRadius: 20,
    alignItems: 'center',
    justifyContent: 'center',
  },
  heart: { fontSize: 20 },
  itemName: { fontSize: 15, fontWeight: '700', color: '#111827', padding: 12, paddingBottom: 2 },
  itemCategory: { fontSize: 12, color: '#6b7280', paddingHorizontal: 12 },
  footer: { flexDirection: 'row', justifyContent: 'space-between', alignItems: 'center', padding: 12, paddingTop: 8 },
  itemPrice: { fontSize: 16, fontWeight: '800', color: '#f59e0b' },
  addButton: { backgroundColor: '#fef3c7', paddingHorizontal: 12, paddingVertical: 6, borderRadius: 10 },
  addButtonText: { fontSize: 12, fontWeight: '700', color: '#b45309' },
  emptyState: { alignItems: 'center', marginTop: 80 },
  emptyEmoji: { fontSize: 64, marginBottom: 16 },
  emptyTitle: { fontSize: 18, fontWeight: '800', color: '#111827', marginBottom: 6 },
  emptyText: { fontSize: 14, color: '#6b7280' },
});
