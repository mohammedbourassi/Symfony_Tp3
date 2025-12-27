# Page Produit Symfony

## Description

Cette page permet à un utilisateur de voir un produit et de l'ajouter à son panier sur un site e-commerce. Le projet utilise **Symfony** et **Bootstrap 5**.

---

## Template Twig (`show.html.twig`)

Le fichier Twig est responsable de l’affichage de la page produit.

- Bootstrap 5 est utilisé pour le style et le rendu responsive.

- La page est divisée en deux colonnes :

    - Colonne gauche : affiche l’image du produit.

    - Colonne droite : affiche le nom, le prix, la description, les caractéristiques, et le formulaire.

```twig
<img src="{{ product.image }}" class="img-fluid rounded" alt="{{ product.name }}">
<h1>{{ product.name }}</h1>
<p>${{ product.price }}</p>

<ul>
  <li>Brand: {{ product.brand }}</li>
  <li>Color: {{ product.color }}</li>
  <li>Connectivity: {{ product.connectivity }}</li>
  <li>Battery Life: {{ product.battery }}</li>
</ul>

{{ form_start(form) }}
  {{ form_row(form.quantity) }}
  {{ form_row(form.color) }}
  {{ form_widget(form.add) }}
{{ form_end(form) }}

```
- form_start(form) et form_end(form) génèrent automatiquement les balises <form> et la sécurité CSRF.
- form_row() rend le label, l’input et les erreurs du champ automatiquement.
- form_widget() rend uniquement le widget (ici le bouton “Add to Cart”).

## Formulaire Symfony (AddToCartType.php)

Le formulaire est créé avec Symfony Form Component.
- Champs du formulaire
    - Quantity (IntegerType)
    - Minimum : 1, maximum : 99
    - Valeur par défaut : 1
    - Classe CSS Bootstrap pour le style

- Color (ChoiceType)
    - Options disponibles : Matte Black, Pearl White, Silver
    - Affichage en select grâce à la classe Bootstrap form-select

- Submit (SubmitType)
    - Bouton “Add to Cart”
    - Classe Bootstrap btn btn-primary btn-lg

```php
$builder
    ->add('quantity', IntegerType::class, [
        'attr' => ['min'=>1,'max'=>99,'class'=>'form-control']
    ])
    ->add('color', ChoiceType::class, [
        'choices'=>['Matte Black'=>'black','Pearl White'=>'white','Silver'=>'silver'],
        'attr'=>['class'=>'form-select']
    ])
    ->add('add', SubmitType::class, ['label'=>'Add to Cart','attr'=>['class'=>'btn btn-primary btn-lg']]);

```
- Les valeurs des champs sont automatiquement récupérées dans le contrôleur.
- L’interface est responsive grâce aux classes Bootstrap.

## Contrôleur Symfony (ProductController.php)
- Le contrôleur gère :
- La route dynamique /product/{id}
- La récupération des données produit (ici simulées)
- La création et la gestion du formulaire
- La validation et le traitement du formulaire
- Le rendu de la vue avec le produit et le formulaire

```php
$product = [
    'id' => $id,
    'name' => 'Premium Wireless Headphones',
    'price' => 129.99,
    'brand' => 'AudioTech',
    'color' => 'Matte Black',
    'connectivity' => 'Bluetooth 5.0',
    'battery' => '30 hours',
    'image' => 'https://images.pexels.com/photos/90946/pexels-photo-90946.jpeg'
];

$form = $this->createForm(AddToCartType::class);
$form->handleRequest($request);

if ($form->isSubmitted() && $form->isValid()) {
    $data = $form->getData();
    $this->addFlash('success', 'Produit ajouté au panier');
}

return $this->render('product/show.html.twig', [
    'product' => $product,
    'form' => $form->createView()
]);

```
- createForm() : crée le formulaire Symfony
- handleRequest() : lie le formulaire aux données de la requête HTTP
- isSubmitted() + isValid() : vérifie si le formulaire a été soumis et validé
- addFlash() : envoie un message temporaire à l’utilisateur
- render() : envoie les données à la vue Twig pour affichage
- 
## Fonctionnement

- L’utilisateur visite /product/{id}
- Symfony récupère les informations du produit et affiche le formulaire
- L’utilisateur choisit la quantité et la couleur
- Il clique sur “Add to Cart”
- Symfony récupère les données

<img width="1798" height="768" alt="Screenshot 2025-12-27 012623" src="https://github.com/user-attachments/assets/83a2c225-6b72-4817-92c2-5d1e6c127da9" />
<img width="984" height="240" alt="Screenshot 2025-12-27 012703" src="https://github.com/user-attachments/assets/c8d4d71c-d195-486b-a1d2-08c8e6874117" />
