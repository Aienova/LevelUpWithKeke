// This is your test publishable API key.
const stripe = Stripe("pk_test_51OWJYYGFZkusNLgjVIk776TXwew6Vewpx78Ytp7ck9eBMjpRVnQc0EmRzFb7HGTnqRLAh5sevUn1bfd1eie3wntm00cDjSgKs8");

initialize();

// Create a Checkout Session as soon as the page loads
async function initialize() {
  const response = await fetch("/checkout.php", {
    method: "POST",
  });

  const { clientSecret } = await response.json();

  const checkout = await stripe.initEmbeddedCheckout({
    clientSecret,
  });

  // Mount Checkout
  checkout.mount('#checkout');
}