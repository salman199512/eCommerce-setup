import React from 'react';
import { View, Text, ScrollView, TouchableOpacity, StyleSheet, Image } from 'react-native';
import { useRoute, useNavigation } from '@react-navigation/native';

export default function ProductDetailScreen() {
  const route = useRoute();
  const navigation = useNavigation();
  const product = route.params?.product || {};

  return (
    <ScrollView style={styles.container} contentContainerStyle={styles.content}>
      <TouchableOpacity style={styles.backButton} onPress={() => navigation.goBack()}>
        <Text style={styles.backText}>← Back</Text>
      </TouchableOpacity>

      <View style={styles.imageWrapper}>
        <Image source={{ uri: product.image }} style={styles.image} />
      </View>

      <View style={styles.infoCard}>
        <Text style={styles.title}>{product.name}</Text>
        <Text style={styles.price}>${product.price}</Text>
        <Text style={styles.tagline}>{product.tagline}</Text>
        <Text style={styles.sectionTitle}>Description</Text>
        <Text style={styles.description}>{product.description}</Text>
        <View style={styles.row}>
          <View style={styles.badge}><Text style={styles.badgeText}>{product.category}</Text></View>
          <View style={styles.badge}><Text style={styles.badgeText}>{product.rating} ★</Text></View>
        </View>
      </View>

      <TouchableOpacity style={styles.checkoutButton} onPress={() => navigation.navigate('Cart')}>
        <Text style={styles.checkoutText}>Add to Cart</Text>
      </TouchableOpacity>
    </ScrollView>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: '#fafaf9' },
  content: { padding: 16, paddingBottom: 48 },
  backButton: { marginVertical: 12, paddingHorizontal: 4 },
  backText: { color: '#111827', fontSize: 16 },
  imageWrapper: {
    backgroundColor: '#ffffff',
    borderRadius: 24,
    overflow: 'hidden',
    height: 300,
    marginBottom: 20,
    borderWidth: 1,
    borderColor: '#f3f4f6',
  },
  image: { width: '100%', height: '100%', resizeMode: 'cover' },
  infoCard: {
    backgroundColor: '#ffffff',
    borderRadius: 24,
    padding: 20,
    borderWidth: 1,
    borderColor: '#f3f4f6',
    shadowColor: '#000',
    shadowOpacity: 0.05,
    shadowRadius: 12,
    elevation: 5,
  },
  title: { fontSize: 24, fontWeight: '800', color: '#111827' },
  price: { fontSize: 24, fontWeight: '700', color: '#f59e0b', marginVertical: 10 },
  tagline: { fontSize: 15, color: '#6b7280', lineHeight: 22 },
  sectionTitle: { fontSize: 16, fontWeight: '700', color: '#111827', marginTop: 18, marginBottom: 10 },
  description: { fontSize: 15, color: '#4b5563', lineHeight: 22 },
  row: { flexDirection: 'row', marginTop: 18, flexWrap: 'wrap' },
  badge: {
    backgroundColor: '#fef3c7',
    paddingHorizontal: 12,
    paddingVertical: 8,
    borderRadius: 16,
    marginRight: 10,
    marginBottom: 8,
  },
  badgeText: { color: '#b45309', fontWeight: '600' },
  checkoutButton: {
    marginTop: 24,
    height: 56,
    borderRadius: 16,
    backgroundColor: '#f59e0b',
    alignItems: 'center',
    justifyContent: 'center',
  },
  checkoutText: { color: '#ffffff', fontSize: 16, fontWeight: '700' },
});
