<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/partials.php';

$hotDeals = get_hot_deals(null, 12);
$popular  = get_popular_products(6);
$cats     = get_categories();

include __DIR__ . '/includes/header.php';
?>

<section class="hero"> 
  <div class="container">
    <h1>똑똑한 쇼핑, <span class="highlight"><?= h(SITE_NAME) ?></span></h1>
    <p>전문가가 엄선한 카테고리별 베스트 제품 비교</p>
    <div class="hero-tags">
      <a href="smart-home.php" class="tag">로봇청소기</a>
      <a href="smart-home.php" class="tag">음식물처리기</a>
      <a href="digital.php" class="tag">태블릿</a>
      <a href="digital.php" class="tag">이어폰</a> 
      <a href="living.php" class="tag">영양제</a>
    </div>
  </div> 
</section>
<section class="section hot-deals-section"> 
  <div class="container">
    <div class="section-header">
      <h2>🔥 오늘의 핫딜 <span class="badge-live">LIVE</span></h2>
      <a href="hot-deals.php" class="more-link">전체보기 →</a>
    </div>
    <p class="section-desc">쿠팡 골드박스 · 타임세일 중 할인율 높은 제품만 모았어요</p>
    <div class="deal-grid">
      <?php foreach ($hotDeals as $d) render_deal_card($d); ?>
      <?php if (!$hotDeals): ?><p style="color:#999;">등록된 핫딜이 없습니다. <a href="admin/products.php">관리자</a>에서 등록해주세요.</p><?php endif; ?>
    </div>
  </div> 
</section>

<?php foreach ($cats as $c):
  $catProducts = get_products_by_category($c['slug'], 12);
  if (!$catProducts) continue;
?>
<section class="section">
  <div class="container">
    <div class="section-header">
      <h2><?= h($c['icon']) ?> <?= h($c['name']) ?></h2>
      <a href="<?= h($c['slug']) ?>.php" class="more-link">전체보기 →</a>
    </div>
    <p class="section-desc"><?= h($c['description']) ?></p>
    <div class="deal-grid">
      <?php foreach ($catProducts as $p) render_deal_card($p); ?>
    </div>
  </div>
</section>
<?php endforeach; ?>

<section class="section">
  <div class="container">
    <h2 class="section-title">이번 주 인기 비교</h2>
    <div class="popular-grid">
      <?php $i = 1; foreach ($popular as $p): ?>
        <a href="<?= h($p['category_slug']) ?>.php" class="popular-card">
          <div class="popular-rank"><?= $i++ ?></div>
          <div class="popular-info">
            <span class="popular-cat"><?= h($p['category_name']) ?></span>
            <h4><?= h($p['name']) ?></h4>
            <span class="popular-meta">조회 <?= number_format((int)$p['views']) ?></span>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
