'use client';

export default function GoogleLoginButton() {
  const handleGoogleLogin = async () => {
    const res = await fetch('http://localhost:9000/api/auth/google/url');
    const { url } = await res.json();
    window.location.href = url;
  };

  return (
    <button onClick={handleGoogleLogin}
      className="flex items-center gap-2 px-4 py-2 border rounded-lg hover:bg-gray-50">
      <img src="https://www.google.com/favicon.ico" className="w-5 h-5" />
      Continue with Google
    </button>
  );
}