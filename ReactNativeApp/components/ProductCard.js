import React from 'react';
import { View, Text, TouchableOpacity, StyleSheet, Image } from 'react-native';

export default function ProductCard({ product, onPress, compact }) {
  return (
    <TouchableOpacity onPress={onPress} style={[styles.card, compact ? styles.compactCard : styles.defaultCard]}>
      <Image source={{ uri: product.image }} style={[styles.image, compact ? styles.compactImage : null]} />
      <View style={styles.textGroup}>
        <Text style={styles.name}>{product.name}</Text>
        <Text style={styles.category}>{product.category}</Text>
        <Text style={styles.price}>${product.price}</Text>
      </View>
    </TouchableOpacity>
  );
}

const styles = StyleSheet.create({
  card: {
    backgroundColor: '#ffffff',
    borderRadius: 22,
    overflow: 'hidden',
    marginRight: 14,
    borderWidth: 1,
    borderColor: '#f3f4f6',
    shadowColor: '#000',
    shadowOpacity: 0.05,
    shadowRadius: 10,
    elevation: 4,
  },
  defaultCard: { width: 220 },
  compactCard: {
    width: '48%',
    marginBottom: 16,
  },
  image: {
    width: '100%',
    height: 140,
  },
  compactImage: {
    height: 120,
  },
  textGroup: { padding: 14 },
  name: { fontSize: 16, fontWeight: '700', color: '#111827' },
  category: { fontSize: 13, color: '#6b7280', marginTop: 6 },
  price: { fontSize: 16, fontWeight: '800', color: '#f59e0b', marginTop: 10 },
});
