module.exports.homeRequestHandler = (req, res) => {
  if(!req.session.user || !req.session.password)
    res.redirect("/login")
  else {
    res.render("home/home_index.html.twig", {login:req.session.user});
  }
}
