import React, { useState } from 'react';
import { View, Text, TouchableOpacity, StyleSheet, ScrollView, Switch } from 'react-native';

export default function SettingsScreen() {
  const [notifications, setNotifications] = useState(true);
  const [darkMode, setDarkMode] = useState(false);

  return (
    <ScrollView style={styles.container} contentContainerStyle={styles.content}>
      <Text style={styles.title}>Settings</Text>

      <View style={styles.section}>
        <Text style={styles.sectionTitle}>Preferences</Text>
        <View style={styles.settingItem}>
          <View>
            <Text style={styles.settingLabel}>Push Notifications</Text>
            <Text style={styles.settingDescription}>Get order updates and offers</Text>
          </View>
          <Switch value={notifications} onValueChange={setNotifications} trackColor={{ false: '#e5e7eb', true: '#fcd34d' }} thumbColor={notifications ? '#f59e0b' : '#6b7280'} />
        </View>

        <View style={styles.settingItem}>
          <View>
            <Text style={styles.settingLabel}>Dark Mode</Text>
            <Text style={styles.settingDescription}>Easier on the eyes</Text>
          </View>
          <Switch value={darkMode} onValueChange={setDarkMode} trackColor={{ false: '#e5e7eb', true: '#fcd34d' }} thumbColor={darkMode ? '#f59e0b' : '#6b7280'} />
        </View>
      </View>

      <View style={styles.section}>
        <Text style={styles.sectionTitle}>Support</Text>
        <TouchableOpacity style={styles.settingButton}>
          <Text style={styles.settingButtonText}>📞 Contact Us</Text>
        </TouchableOpacity>
        <TouchableOpacity style={styles.settingButton}>
          <Text style={styles.settingButtonText}>❓ Help & FAQ</Text>
        </TouchableOpacity>
        <TouchableOpacity style={styles.settingButton}>
          <Text style={styles.settingButtonText}>📋 Terms of Service</Text>
        </TouchableOpacity>
        <TouchableOpacity style={styles.settingButton}>
          <Text style={styles.settingButtonText}>🔒 Privacy Policy</Text>
        </TouchableOpacity>
      </View>

      <View style={styles.section}>
        <Text style={styles.sectionTitle}>About</Text>
        <View style={styles.infoBox}>
          <Text style={styles.appName}>Luxura</Text>
          <Text style={styles.appVersion}>Version 1.0.0</Text>
        </View>
      </View>
    </ScrollView>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: '#fafaf9' },
  content: { padding: 16, paddingBottom: 48 },
  title: { fontSize: 28, fontWeight: '800', color: '#111827', marginBottom: 24 },
  section: { marginBottom: 28 },
  sectionTitle: { fontSize: 14, fontWeight: '800', color: '#f59e0b', textTransform: 'uppercase', letterSpacing: 0.8, marginBottom: 12 },
  settingItem: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    backgroundColor: '#ffffff',
    borderRadius: 16,
    padding: 16,
    marginBottom: 8,
    borderWidth: 1,
    borderColor: '#f3f4f6',
  },
  settingLabel: { fontSize: 15, fontWeight: '700', color: '#111827' },
  settingDescription: { fontSize: 13, color: '#6b7280', marginTop: 4 },
  settingButton: {
    backgroundColor: '#ffffff',
    borderRadius: 16,
    padding: 16,
    marginBottom: 8,
    borderWidth: 1,
    borderColor: '#f3f4f6',
  },
  settingButtonText: { fontSize: 15, fontWeight: '600', color: '#111827' },
  infoBox: {
    backgroundColor: '#ffffff',
    borderRadius: 16,
    padding: 16,
    borderWidth: 1,
    borderColor: '#f3f4f6',
    alignItems: 'center',
  },
  appName: { fontSize: 18, fontWeight: '800', color: '#f59e0b' },
  appVersion: { fontSize: 13, color: '#6b7280', marginTop: 4 },
});
