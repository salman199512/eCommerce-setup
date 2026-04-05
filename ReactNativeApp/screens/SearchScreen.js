import React, { useState } from 'react';
import { View, Text, TextInput, ScrollView, TouchableOpacity, StyleSheet } from 'react-native';
import ProductCard from '../components/ProductCard';
import { featuredProducts, bestSellers } from '../data/shopData';

export default function SearchScreen() {
  const [query, setQuery] = useState('');
  const results = [...featuredProducts, ...bestSellers].filter(product =>
    product.name.toLowerCase().includes(query.toLowerCase()) ||
    product.category.toLowerCase().includes(query.toLowerCase())
  );

  return (
    <View style={styles.container}>
      <Text style={styles.title}>Search</Text>
      <TextInput
        style={styles.input}
        placeholder="Search for products"
        value={query}
        onChangeText={setQuery}
      />

      <ScrollView contentContainerStyle={styles.results}>
        {results.length ? (
          results.map(product => (
            <ProductCard key={product.id} product={product} />
          ))
        ) : (
          <Text style={styles.emptyText}>No products match your search.</Text>
        )}
      </ScrollView>
    </View>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: '#fafaf9', padding: 16 },
  title: { fontSize: 28, fontWeight: '800', color: '#111827', marginBottom: 18 },
  input: {
    backgroundColor: '#ffffff',
    borderRadius: 18,
    paddingVertical: 14,
    paddingHorizontal: 18,
    borderWidth: 1.5,
    borderColor: '#f3f4f6',
    marginBottom: 20,
  },
  results: { paddingBottom: 40 },
  emptyText: { color: '#6b7280', marginTop: 20, fontSize: 16, textAlign: 'center' },
});
