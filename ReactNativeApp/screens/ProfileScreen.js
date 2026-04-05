import React from 'react';
import { View, Text, TouchableOpacity, StyleSheet } from 'react-native';
import { useNavigation } from '@react-navigation/native';

export default function ProfileScreen() {
  const navigation = useNavigation();

  return (
    <View style={styles.container}>
      <View style={styles.profileCard}>
        <Text style={styles.greeting}>Welcome back</Text>
        <Text style={styles.name}>Sophia Parker</Text>
        <Text style={styles.email}>sophia.parker@example.com</Text>
      </View>

      <View style={styles.actionsGrid}>
        <TouchableOpacity style={styles.actionButton} onPress={() => navigation.navigate('Orders')}>
          <Text style={styles.actionLabel}>📦 Orders</Text>
        </TouchableOpacity>
        <TouchableOpacity style={styles.actionButton} onPress={() => navigation.navigate('Wishlist')}>
          <Text style={styles.actionLabel}>❤️ Wishlist</Text>
        </TouchableOpacity>
        <TouchableOpacity style={styles.actionButton} onPress={() => navigation.navigate('ProfileUpdate')}>
          <Text style={styles.actionLabel}>✏️ Edit Profile</Text>
        </TouchableOpacity>
        <TouchableOpacity style={styles.actionButton} onPress={() => navigation.navigate('Notifications')}>
          <Text style={styles.actionLabel}>🔔 Notifications</Text>
        </TouchableOpacity>
        <TouchableOpacity style={styles.actionButton} onPress={() => navigation.navigate('Settings')}>
          <Text style={styles.actionLabel}>⚙️ Settings</Text>
        </TouchableOpacity>
        <TouchableOpacity style={styles.actionButton}>
          <Text style={styles.actionLabel}>📞 Help</Text>
        </TouchableOpacity>
      </View>

      <View style={styles.statsCard}>
        <Text style={styles.statsTitle}>Account overview</Text>
        <View style={styles.statsRow}>
          <View style={styles.statBlock}>
            <Text style={styles.statLabel}>Orders</Text>
            <Text style={styles.statValue}>18</Text>
          </View>
          <View style={styles.statBlock}>
            <Text style={styles.statLabel}>Saved</Text>
            <Text style={styles.statValue}>34</Text>
          </View>
        </View>
      </View>
    </View>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, padding: 16, backgroundColor: '#fafaf9' },
  profileCard: {
    backgroundColor: '#ffffff',
    borderRadius: 24,
    padding: 24,
    marginBottom: 20,
    borderWidth: 1,
    borderColor: '#f3f4f6',
  },
  greeting: { color: '#6b7280', fontSize: 15, marginBottom: 8 },
  name: { fontSize: 28, fontWeight: '800', color: '#111827' },
  email: { color: '#6b7280', marginTop: 6 },
  actionsGrid: {
    flexDirection: 'row',
    flexWrap: 'wrap',
    justifyContent: 'space-between',
    marginBottom: 20,
  },
  actionButton: {
    width: '48%',
    backgroundColor: '#ffffff',
    borderRadius: 20,
    paddingVertical: 22,
    alignItems: 'center',
    justifyContent: 'center',
    marginBottom: 12,
    borderWidth: 1,
    borderColor: '#f3f4f6',
  },
  actionLabel: { fontSize: 15, fontWeight: '700', color: '#f59e0b' },
  statsCard: {
    backgroundColor: '#ffffff',
    borderRadius: 24,
    padding: 20,
    borderWidth: 1,
    borderColor: '#f3f4f6',
  },
  statsTitle: { fontSize: 16, fontWeight: '700', color: '#111827', marginBottom: 14 },
  statsRow: { flexDirection: 'row', justifyContent: 'space-between' },
  statBlock: { width: '48%' },
  statLabel: { color: '#6b7280', marginBottom: 6 },
  statValue: { fontSize: 22, fontWeight: '800', color: '#f59e0b' },
});
