import React from 'react';
import { View, Text, ScrollView, StyleSheet } from 'react-native';
import CategoryCard from '../components/CategoryCard';
import ProductCard from '../components/ProductCard';
import SectionHeader from '../components/SectionHeader';
import { categories, featuredProducts } from '../data/shopData';

export default function CategoryScreen() {
  return (
    <ScrollView style={styles.container} contentContainerStyle={styles.content}>
      <View style={styles.hero}>
        <Text style={styles.heroTitle}>Shop by category</Text>
        <Text style={styles.heroSubtitle}>Find the right collection for every moment.</Text>
      </View>

      <SectionHeader title="Categories" />
      <View style={styles.categoriesGrid}>
        {categories.map(category => (
          <CategoryCard key={category.id} category={category} large />
        ))}
      </View>

      <SectionHeader title="Featured Picks" subtitle="Fresh arrivals for you" />
      <ScrollView horizontal showsHorizontalScrollIndicator={false} style={styles.horizontalScroll}>
        {featuredProducts.map(product => (
          <ProductCard key={product.id} product={product} />
        ))}
      </ScrollView>
    </ScrollView>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: '#fafaf9' },
  content: { paddingHorizontal: 16, paddingTop: 24, paddingBottom: 40 },
  hero: { marginBottom: 24 },
  heroTitle: { fontSize: 26, fontWeight: '800', color: '#111827' },
  heroSubtitle: { fontSize: 15, color: '#6b7280', marginTop: 8 },
  categoriesGrid: { flexDirection: 'row', flexWrap: 'wrap', justifyContent: 'space-between' },
  horizontalScroll: { marginTop: 12 },
});
