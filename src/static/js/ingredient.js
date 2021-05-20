
// INSERTING POST
app.post('/ingredient', (req, res) => {
  const title = req.body.title;
  const content = req.body.content;
  const author_name = req.body.author_name;
  const post = {
    title: title,
    content: content,
    author: author_name,
    created_at: new Date()
  }
  Client.query('INSERT INTO ingredient SET ?', post, (err) => {
    if (err) throw err;
    console.log('Data inserted');
    return res.redirect('/');
  });
});

// EDIT PAGE
app.get('ingredient/edit/:id', (req, res) => {
  const edit_postId = req.params.id;
  // FIND POST BY ID
  Client.query('SELECT * FROM ingredient WHERE id=?',[edit_postId] , (err, results) => {
    if (err) throw err;
    res.render('edit',{
      post:results[0]
    });
  });
});

// POST UPDATING
app.post('ingredient/edit/:id', (req, res) => {
  const update_title = req.body.title;
  const update_content = req.body.content;
  const update_author_name = req.body.author_name;
  const userId = req.params.id;
  Client.query('UPDATE ingredient SET title = ?, content = ?, author = ? WHERE id = ?', [update_title, update_content, update_author_name, userId], (err, results) => {
    if (err) throw err;
    if(results.changedRows === 1){
      console.log('Post Updated');
      return res.redirect('/');
    }
  });
});

// POST DELETING
app.get('ingredient/delete/:id', (req, res) => {
  Client.query('DELETE FROM ingredient WHERE id = ?', [req.params.id], (err, results) => {
    if (err) throw err;
    res.redirect('/');
  });
});

// SET 404 PAGE
app.use('/',(req,res) => {
  res.status(404).send('<h1>404 Page Not Found!</h1>');
});

// IF DATABASE Client IS SUCCESSFUL
Client.connect((err) => {
  if (err) throw err;
  app.listen(3000);
});
