const express = require('express')
const bodyParser = require('body-parser')
var stripe = require('stripe')('sk_test_zew7b2AUBQfeVtnOSlt0O0nO')

// Create an express app
const app = express()

// Use body parser so we can parse the body of requests
app.use(bodyParser.json())

// Just a sanity check endpoint we can hit in the browser
app.get('/', function (req, res) {
  res.send('Hello World!')
})

app.post('/pay', function (req, res) {
  console.log('Pay request')

  var token = req.body.stripeToken
  var amount = req.body.amount
  var description = req.body.description

  stripe.charges.create({
  amount: amount,
  currency: "usd",
  description: description,
  source: token,
  }, function(err, charge) {
    if (err !== null) {
      console.log('error capturing')
      console.log(err)
      res.status(400).send('error')
    } else {
      console.log('success')
      res.status(200).send('success')
    }
  });
})

app.listen(3000, () => {
  console.log('apple-pay-backend app listening on port 3000')
})
