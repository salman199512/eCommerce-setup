import React from 'react';
import { View, Text, StyleSheet } from 'react-native';

export default function SectionHeader({ title, subtitle }) {
  return (
    <View style={styles.container}>
      <View>
        <Text style={styles.title}>{title}</Text>
        {subtitle ? <Text style={styles.subtitle}>{subtitle}</Text> : null}
      </View>
    </View>
  );
}

const styles = StyleSheet.create({
  container: { marginBottom: 14, flexDirection: 'row', justifyContent: 'space-between', alignItems: 'center' },
  title: { fontSize: 18, fontWeight: '800', color: '#111827' },
  subtitle: { color: '#6b7280', marginTop: 4, fontSize: 13 },
});
