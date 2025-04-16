<!-- Sidebar responsive (offcanvas móvil + fijo en desktop) -->
<div class="offcanvas-lg offcanvas-start bg-dark text-white sidebar-desktop" tabindex="-1" id="offcanvasSidebar">
  <div class="offcanvas-header border-bottom d-lg-none">
    <h5 class="offcanvas-title text-info">📊 Panel</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
  </div>

  <div class="offcanvas-body p-4">
    <div class="sidebar-heading fw-bold mb-4 text-info d-none d-lg-block">📊 Panel</div>
    <?php include __DIR__ . '/menu.php'; ?>
  </div>
</div>
