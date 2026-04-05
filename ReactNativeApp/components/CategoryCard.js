import React from 'react';
import { View, Text, TouchableOpacity, StyleSheet } from 'react-native';

export default function CategoryCard({ category, large }) {
  return (
    <TouchableOpacity style={[styles.card, large ? styles.largeCard : styles.smallCard]}>
      <View style={styles.iconWrapper}>
        <Text style={styles.icon}>{category.icon}</Text>
      </View>
      <Text style={[styles.label, large ? styles.largeLabel : null]}>{category.name}</Text>
      {category.items && <Text style={styles.count}>{category.items} items</Text>}
    </TouchableOpacity>
  );
}

const styles = StyleSheet.create({
  card: {
    backgroundColor: '#ffffff',
    borderRadius: 22,
    padding: 18,
    marginRight: 14,
    borderWidth: 1,
    borderColor: '#f3f4f6',
    shadowColor: '#000',
    shadowOpacity: 0.05,
    shadowRadius: 10,
    elevation: 4,
  },
  smallCard: { width: 140 },
  largeCard: { width: '48%', marginBottom: 16 },
  iconWrapper: {
    width: 48,
    height: 48,
    borderRadius: 16,
    backgroundColor: '#fef3c7',
    alignItems: 'center',
    justifyContent: 'center',
    marginBottom: 14,
  },
  icon: { fontSize: 24 },
  label: { fontSize: 16, fontWeight: '700', color: '#111827' },
  largeLabel: { fontSize: 18 },
  count: { color: '#6b7280', marginTop: 6 },
});
