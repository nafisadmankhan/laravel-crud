'use client';

import { useEffect } from 'react';
import { useRouter, useSearchParams } from 'next/navigation';

export default function AuthCallback() {
  const router = useRouter();
  const searchParams = useSearchParams();

  useEffect(() => {
    const token = searchParams.get('token');
    const error = searchParams.get('error');

    if (token) {
      localStorage.setItem('auth_token', token);
      router.replace('/dashboard'); // redirect to your app
    } else {
      router.replace('/login?error=' + (error || 'unknown'));
    }
  }, []);

  return <p>Signing you in...</p>;
}