/* ============================================================
   YumBook – main.js
   Author: B.L.Chamodi Nadeesha | ASB/2023/163
   ============================================================ */

/* ---- Scroll Reveal ---- */
function initScrollReveal() {
  const els = document.querySelectorAll('.reveal');
  const io = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); } });
  }, { threshold: 0.15 });
  els.forEach(el => io.observe(el));
}

/* ---- Toast ---- */
function showToast(msg, type = 'success') {
  let t = document.getElementById('toastYum');
  if (!t) {
    t = document.createElement('div');
    t.id = 'toastYum';
    t.className = 'toast-yum';
    document.body.appendChild(t);
  }
  t.textContent = msg;
  t.className = `toast-yum show ${type}`;
  clearTimeout(t._timer);
  t._timer = setTimeout(() => t.classList.remove('show'), 3500);
}

/* ---- Active nav link ---- */
function setActiveNav() {
  const page = location.pathname.split('/').pop() || 'index.html';
  document.querySelectorAll('.nav-link').forEach(a => {
    const href = a.getAttribute('href');
    if (href === page) a.classList.add('active');
    else a.classList.remove('active');
  });
}

/* ---- Recipe Data ---- */
const RECIPES = [
  { id:1, title:'Chicken Tikka Masala',   cat:'Dinner',    time:'50 min', servings:4, img:'https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=600&q=80', desc:'Tender marinated chicken in a rich, spiced tomato-cream sauce. Best served with fluffy basmati rice.', ingredients:['600g chicken breast','200ml yogurt','400g tomatoes','200ml cream','Tikka spice blend','Garlic & ginger'], steps:['Marinate chicken with yogurt and spices for 2 hrs.','Grill or pan-fry chicken until charred.','Sauté onions, garlic, ginger; add tomatoes; simmer 15 min.','Add cream and chicken; simmer 10 min. Serve with rice.'] },
  { id:2, title:'Avocado Toast',          cat:'Breakfast', time:'10 min', servings:2, img:'https://images.unsplash.com/photo-1588137378633-dea1336ce1e2?w=600&q=80',desc:'Creamy smashed avocado on toasted sourdough with a sprinkle of chilli flakes and lemon juice.', ingredients:['2 slices sourdough bread','1 ripe avocado','Lemon juice','Chilli flakes','Salt & pepper','2 eggs (optional)'], steps:['Toast the sourdough slices.','Halve, pit and scoop avocado; mash with lemon juice, salt, pepper.','Spread onto toast generously.','Top with chilli flakes. Add a poached egg if desired.'] },
  { id:3, title:'Spaghetti Carbonara',    cat:'Dinner',    time:'25 min', servings:4, img:'https://images.unsplash.com/photo-1612874742237-6526221588e3?w=600&q=80', desc:'A creamy Italian classic with eggs, cheese, pancetta, and black pepper. Rich, silky, and endlessly satisfying.', ingredients:['400g spaghetti','200g pancetta','4 eggs','100g Pecorino Romano','Black pepper','Salt'], steps:['Cook spaghetti in salted water until al dente.','Fry pancetta until crispy.','Whisk eggs and cheese together.','Combine pasta with pancetta off-heat.','Add egg mixture quickly, toss well. Season generously.'] }, 
  { id:4, title:'Mango Sticky ',          cat:'Desserts',  time:'40 min', servings:4, img:'https://images.unsplash.com/photo-1621939514649-280e2ee25f60?w=700&q=80', desc:'Thai street-food classic — glutinous rice soaked in sweet coconut milk, served with fresh mango slices.', ingredients:['2 cups glutinous rice','400ml coconut milk','4 tbsp sugar','1 tsp salt','2 ripe mangoes'], steps:['Soak rice overnight; steam for 20 min.','Heat coconut milk with sugar and salt until dissolved.','Mix half the coconut milk into warm rice; rest 15 min.','Slice mangoes. Serve rice topped with mango and remaining coconut sauce.'] },
  { id:5, title:'Caesar Salad',           cat:'Lunch',     time:'15 min', servings:3, img:'https://images.unsplash.com/photo-1550304943-4f24f54ddde9?w=600&q=80', desc:'Crisp romaine lettuce, house-made Caesar dressing, shaved Parmesan, and golden croutons.', ingredients:['1 romaine lettuce','3 tbsp Caesar dressing','50g Parmesan','Croutons','1 tsp Worcestershire','Lemon juice'], steps:['Wash and chop romaine.','Whisk dressing with Worcestershire and lemon.','Toss lettuce with dressing.','Top with Parmesan and croutons. Serve immediately.'] }, 
  { id:6, title:'Pancakes',               cat:'Breakfast', time:'20 min', servings:4, img:'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=600&q=80', desc:'Fluffy buttermilk pancakes stacked high with maple syrup, fresh berries, and a pat of butter.', ingredients:['2 cups flour','2 tbsp sugar','2 tsp baking powder','2 eggs','1.5 cups buttermilk','3 tbsp melted butter'], steps:['Whisk dry ingredients together.','Mix wet ingredients separately.','Fold wet into dry until just combined (lumps are OK).','Cook on a greased griddle over medium heat, 2 min per side.'] },
  { id:7, title:'Chocolate Lava Cake',    cat:'Desserts',  time:'25 min', servings:4, img:'https://images.unsplash.com/photo-1606313564200-e75d5e30476c?w=600&q=80', desc:'Warm chocolate cakes with a gooey molten centre. A crowd-pleasing indulgence, ready in 25 minutes.', ingredients:['200g dark chocolate','100g butter','3 eggs','3 egg yolks','60g sugar','30g flour'], steps:['Melt chocolate and butter together.','Whisk eggs, yolks and sugar until pale.','Fold chocolate into egg mix; add flour.','Pour into greased ramekins. Bake 200°C for 10 min. Serve immediately.'] },
  { id:8, title:'Greek Salad',            cat:'Lunch',     time:'10 min', servings:4, img:'https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?w=600&q=80', desc:'A refreshing medley of tomatoes, cucumber, olives, red onion, and creamy feta with olive oil dressing.', ingredients:['3 tomatoes','1 cucumber','100g feta','50g olives','Half red onion','3 tbsp olive oil','Oregano'], steps:['Chop tomatoes, cucumber and onion.','Combine all vegetables in a bowl.','Add feta and olives.','Drizzle with olive oil; season with oregano, salt, pepper.'] },
];



window.RECIPES = RECIPES;
window.showToast = showToast;

document.addEventListener('DOMContentLoaded', () => {
  setActiveNav();
  initScrollReveal();
});
