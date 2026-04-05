import React from 'react';
import { View, Text, ScrollView, TouchableOpacity, StyleSheet } from 'react-native';
import { useNavigation } from '@react-navigation/native';
import CategoryCard from '../components/CategoryCard';
import ProductCard from '../components/ProductCard';
import SectionHeader from '../components/SectionHeader';
import { categories, bestSellers, featuredProducts } from '../data/shopData';

export default function HomeScreen() {
  const navigation = useNavigation();

  return (
    <ScrollView style={styles.container} contentContainerStyle={styles.content}> 
      <View style={styles.header}>
        <Text style={styles.title}>Shop by Style</Text>
        <Text style={styles.subtitle}>Fast, secure, and beautiful shopping.</Text>
      </View>

      <TouchableOpacity style={styles.searchBar} onPress={() => navigation.navigate('Search')}>
        <Text style={styles.searchText}>Search products, brands, categories</Text>
      </TouchableOpacity>

      <SectionHeader title="Top Categories" />
      <ScrollView horizontal showsHorizontalScrollIndicator={false} style={styles.horizontalScroll}>
        {categories.map(category => (
          <CategoryCard key={category.id} category={category} />
        ))}
      </ScrollView>

      <SectionHeader title="Recommended" subtitle="Based on your browsing" />
      <ScrollView horizontal showsHorizontalScrollIndicator={false} style={styles.horizontalScroll}>
        {featuredProducts.map(product => (
          <ProductCard key={product.id} product={product} onPress={() => navigation.navigate('ProductDetail', { product })} />
        ))}
      </ScrollView>

      <SectionHeader title="Best Sellers" subtitle="Popular choices today" />
      <View style={styles.grid}>
        {bestSellers.map(product => (
          <ProductCard key={product.id} product={product} onPress={() => navigation.navigate('ProductDetail', { product })} compact />
        ))}
      </View>
    </ScrollView>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: '#fafaf9' },
  content: { paddingHorizontal: 16, paddingTop: 24, paddingBottom: 48 },
  header: { marginBottom: 16 },
  title: { fontSize: 28, fontWeight: '800', color: '#111827', fontFamily: 'Arial' },
  subtitle: { fontSize: 15, color: '#6b7280', marginTop: 6 },
  searchBar: {
    backgroundColor: '#ffffff',
    borderRadius: 16,
    paddingVertical: 14,
    paddingHorizontal: 18,
    marginBottom: 20,
    borderWidth: 1.5,
    borderColor: '#f3f4f6',
  },
  searchText: { color: '#9ca3af' },
  horizontalScroll: { marginBottom: 24 },
  grid: { flexDirection: 'row', flexWrap: 'wrap', justifyContent: 'space-between' },
});
