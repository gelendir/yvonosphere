
DELETE FROM categories;

INSERT INTO categories (
    nom
) VALUES (
    'geek'
);

INSERT INTO categories (
    nom
) VALUES (
    'professeur'
);

INSERT INTO categories (
    nom
) VALUES (
    'anonyme'
);

DELETE FROM utilisateurs;

INSERT INTO utilisateurs(
    username,
    password,
    nom,
    prenom,
    admin,
    categorie_id,
    theme
) VALUES (
    'greg',
    '81dc9bdb52d04dc20036dbd8313ed055',
    'Sanderson',
    'Gregory Eric',
    TRUE,
    ( SELECT id FROM categories WHERE nom = 'geek' ),
    'vert'
);

INSERT INTO utilisateurs(
    username,
    password,
    nom,
    prenom,
    admin,
    categorie_id,
    theme
) VALUES (
    'fred',
    '81dc9bdb52d04dc20036dbd8313ed055',
    'Paradis',
    'Frédérik',
    TRUE,
    ( SELECT id FROM categories WHERE nom = 'geek' ),
    'vert'
);

INSERT INTO utilisateurs(
    username,
    password,
    nom,
    prenom,
    admin,
    categorie_id,
    theme
) VALUES (
    'yvon',
    '81dc9bdb52d04dc20036dbd8313ed055',
    'Latulippe',
    'Yvon',
    TRUE,
    ( SELECT id FROM categories WHERE nom = 'professeur' ),
    'vert'
);

INSERT INTO nouvelles(
    nom,
    contenu,
    date_parution,
    categorie_id
) VALUES (
    'Nouvelle sep 2010',
    'Beef ribs shoulder prosciutto sirloin kielbasa, shank pastrami short ribs short loin jowl bresaola pancetta. Short loin filet mignon sausage shank leberkäse, venison cow ham hock. Pork chop andouille pig, ham hock jowl shankle pork loin beef ribs t-bone swine bresaola cow turducken leberkäse biltong. Salami ham hock pork chop, corned beef spare ribs swine brisket shoulder. Andouille filet mignon short ribs t-bone salami, tri-tip short loin hamburger turkey ham corned beef capicola pork loin kielbasa shank. Cow sirloin fatback t-bone ribeye. Tri-tip turkey drumstick pastrami chicken, brisket frankfurter sirloin swine sausage venison filet mignon leberkäse pancetta t-bone.',
    '2010-09-02 12:00:00',
    ( SELECT id FROM categories WHERE nom = 'geek' )
);

INSERT INTO nouvelles(
    nom,
    contenu,
    date_parution,
    categorie_id
) VALUES (
    'Nouvelle fev 2010',
    'Beef ribs shoulder prosciutto sirloin kielbasa, shank pastrami short ribs short loin jowl bresaola pancetta. Short loin filet mignon sausage shank leberkäse, venison cow ham hock. Pork chop andouille pig, ham hock jowl shankle pork loin beef ribs t-bone swine bresaola cow turducken leberkäse biltong. Salami ham hock pork chop, corned beef spare ribs swine brisket shoulder. Andouille filet mignon short ribs t-bone salami, tri-tip short loin hamburger turkey ham corned beef capicola pork loin kielbasa shank. Cow sirloin fatback t-bone ribeye. Tri-tip turkey drumstick pastrami chicken, brisket frankfurter sirloin swine sausage venison filet mignon leberkäse pancetta t-bone.',
    '2010-02-02 12:00:00',
    ( SELECT id FROM categories WHERE nom = 'geek' )
);

INSERT INTO nouvelles(
    nom,
    contenu,
    date_parution,
    categorie_id
) VALUES (
    'Nouvelle mars 2009',
    'Beef ribs shoulder prosciutto sirloin kielbasa, shank pastrami short ribs short loin jowl bresaola pancetta. Short loin filet mignon sausage shank leberkäse, venison cow ham hock. Pork chop andouille pig, ham hock jowl shankle pork loin beef ribs t-bone swine bresaola cow turducken leberkäse biltong. Salami ham hock pork chop, corned beef spare ribs swine brisket shoulder. Andouille filet mignon short ribs t-bone salami, tri-tip short loin hamburger turkey ham corned beef capicola pork loin kielbasa shank. Cow sirloin fatback t-bone ribeye. Tri-tip turkey drumstick pastrami chicken, brisket frankfurter sirloin swine sausage venison filet mignon leberkäse pancetta t-bone.',
    '2009-03-02 12:00:00',
    ( SELECT id FROM categories WHERE nom = 'geek' )
);
