import React from 'react';
import { View, Text, ScrollView, TouchableOpacity, StyleSheet } from 'react-native';
import { notifications } from '../data/shopData';

export default function NotificationsScreen() {
  return (
    <ScrollView style={styles.container} contentContainerStyle={styles.content}>
      <Text style={styles.title}>Notifications</Text>
      <Text style={styles.subtitle}>Stay updated with your orders</Text>

      {notifications.map(notif => (
        <TouchableOpacity key={notif.id} style={[styles.notificationCard, notif.read ? styles.cardRead : styles.cardUnread]}>
          <View style={styles.notifIcon}>
            <Text style={styles.icon}>{notif.icon}</Text>
          </View>
          <View style={styles.notifContent}>
            <Text style={styles.notifTitle}>{notif.title}</Text>
            <Text style={styles.notifMessage}>{notif.message}</Text>
            <Text style={styles.notifTime}>{notif.time}</Text>
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
  notificationCard: {
    flexDirection: 'row',
    backgroundColor: '#ffffff',
    borderRadius: 16,
    padding: 14,
    marginBottom: 12,
    borderWidth: 1,
    borderColor: '#f3f4f6',
  },
  cardUnread: { backgroundColor: '#fef3c7', borderColor: '#f59e0b' },
  cardRead: { opacity: 0.7 },
  notifIcon: {
    width: 48,
    height: 48,
    borderRadius: 12,
    backgroundColor: '#fef3c7',
    alignItems: 'center',
    justifyContent: 'center',
    marginRight: 14,
    flexShrink: 0,
  },
  icon: { fontSize: 24 },
  notifContent: { flex: 1 },
  notifTitle: { fontSize: 15, fontWeight: '700', color: '#111827' },
  notifMessage: { fontSize: 13, color: '#6b7280', marginTop: 3, marginBottom: 6 },
  notifTime: { fontSize: 12, color: '#9ca3af' },
});
