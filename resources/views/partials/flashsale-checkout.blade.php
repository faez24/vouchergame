<style>
@keyframes fsFadeUp{from{opacity:0;transform:translateY(14px)}to{opacity:1;transform:translateY(0)}}
.fs-step-dot{width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:12px;transition:all .3s}
.fs-step-dot.active{background:linear-gradient(135deg,#ec4899,#f43f5e);color:#fff}
.fs-step-dot.done{background:#22c55e;color:#fff}
.fs-step-dot.inactive{background:rgba(255,255,255,.08);color:#6b7280}
.fs-btn-grad{background:linear-gradient(135deg,#ec4899,#f43f5e);transition:all .2s;position:relative;overflow:hidden}
.fs-btn-grad::after{content:'';position:absolute;inset:0;background:linear-gradient(135deg,#f472b6,#fb7185);opacity:0;transition:opacity .2s}
.fs-btn-grad:hover::after{opacity:1}
.fs-btn-grad span{position:relative;z-index:1}
.fs-pay-opt{display:flex;align-items:center;gap:1rem;background:#252d40;border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:14px;cursor:pointer;transition:border-color .2s}
.fs-pay-opt:hover{border-color:rgba(236,72,153,.4)}
</style>

{{-- Flash Sale Checkout Modal — identical pattern to cart --}}
<div id="fs-modal" style="display:none;" class="fixed inset-0 z-[110] items-center justify-center p-4">
  <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="fsClose()"></div>
  <div class="relative w-full max-w-md bg-[#1e2433] border border-white/10 rounded-3xl shadow-[0_30px_80px_rgba(0,0,0,.8)] overflow-hidden" style="animation:fsFadeUp .25s ease">
    {{-- colour bar --}}
    <div class="h-1 w-full" style="background:linear-gradient(90deg,#ec4899,#f43f5e,#3b82f6)"></div>

    <div class="p-6">
      {{-- Step indicator --}}
      <div class="flex items-center justify-center gap-2 mb-6">
        <div id="fs-dot1" class="fs-step-dot active">1</div>
        <div class="h-px w-10 bg-white/10"></div>
        <div id="fs-dot2" class="fs-step-dot inactive">2</div>
      </div>

      {{-- ── STEP 1 ── --}}
      <div id="fs-s1">
        <h3 class="text-white font-black text-lg mb-1">Ringkasan Pesanan</h3>
        <p class="text-gray-500 text-xs mb-5">Lengkapi data dan periksa pesanan</p>

        {{-- User ID input --}}
        <div class="mb-4">
          <label class="block text-gray-400 text-xs font-semibold mb-1.5 uppercase tracking-wider">User ID &amp; Zone ID</label>
          <div class="flex gap-2">
            <input id="fs-uid" type="text" placeholder="User ID"
              class="flex-1 bg-[#252d40] border border-white/10 rounded-xl px-4 py-3 text-white text-sm placeholder-gray-600 outline-none focus:border-pink-500/50 transition-all">
            <input id="fs-zone" type="text" placeholder="Zone"
              class="w-24 bg-[#252d40] border border-white/10 rounded-xl px-4 py-3 text-white text-sm placeholder-gray-600 outline-none focus:border-pink-500/50 transition-all">
          </div>
        </div>

        {{-- Item --}}
        <div class="bg-[#1e2433] rounded-xl px-4 py-3 flex items-center justify-between gap-3 mb-3">
          <div>
            <p class="text-white font-bold text-sm">Mobile Legends · 86 Diamonds</p>
            <p class="text-pink-400 text-xs font-bold mt-0.5">15% OFF Flash Sale</p>
          </div>
          <span class="text-pink-400 font-bold text-sm flex-shrink-0">Rp 21.250</span>
        </div>

        {{-- Total --}}
        <div class="bg-gradient-to-r from-pink-500/10 to-rose-500/10 border border-pink-500/20 rounded-xl px-4 py-4 flex items-center justify-between mb-4">
          <span class="text-gray-300 text-sm font-bold">Total Pembayaran</span>
          <span class="text-pink-400 font-black text-xl">Rp 21.250</span>
        </div>

        <button onclick="fsGoStep2()" class="fs-btn-grad w-full py-3.5 rounded-xl text-white font-black text-sm tracking-wider"><span>Lanjut ke Pembayaran →</span></button>
      </div>

      {{-- ── STEP 2 ── --}}
      <div id="fs-s2" style="display:none;">
        <div class="flex items-center gap-2 mb-5">
          <button onclick="fsGoStep1()" class="text-gray-400 hover:text-white transition-colors">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
          </button>
          <div>
            <h3 class="text-white font-black text-lg">Metode Pembayaran</h3>
            <p class="text-gray-500 text-xs">Pilih cara pembayaran yang kamu inginkan</p>
          </div>
        </div>

        {{-- Identitas --}}
        <div class="bg-[#252d40] rounded-xl px-4 py-3 mb-4 flex items-center justify-between">
          <span class="text-gray-400 text-xs font-semibold uppercase tracking-wider" id="fs-s2-uid">ID: —</span>
          <span class="text-pink-400 font-bold text-sm">Rp 21.250</span>
        </div>

        {{-- Payment options --}}
        <div class="space-y-3 mb-5" id="fs-pay-opts">
          <label class="fs-pay-opt">
            <input type="radio" name="fs_pay" value="QRIS" class="accent-pink-500 w-4 h-4 flex-shrink-0" checked>
            <div class="flex-1"><p class="text-white font-bold text-sm">QRIS</p><p class="text-gray-500 text-xs">Gopay, OVO, Dana, LinkAja</p></div>
            <span class="text-[10px] font-bold text-pink-400 border border-pink-500/30 rounded-full px-2 py-0.5">Gratis Admin</span>
          </label>
          <label class="fs-pay-opt">
            <input type="radio" name="fs_pay" value="GoPay" class="accent-pink-500 w-4 h-4 flex-shrink-0">
            <div class="flex-1"><p class="text-white font-bold text-sm">GoPay</p><p class="text-gray-500 text-xs">Bayar via aplikasi Gojek</p></div>
          </label>
          <label class="fs-pay-opt">
            <input type="radio" name="fs_pay" value="DANA" class="accent-pink-500 w-4 h-4 flex-shrink-0">
            <div class="flex-1"><p class="text-white font-bold text-sm">DANA</p><p class="text-gray-500 text-xs">Bayar via DANA</p></div>
          </label>
        </div>

        <button onclick="fsConfirm()" class="fs-btn-grad w-full py-3.5 rounded-xl text-white font-black text-sm tracking-wider"><span>✓ KONFIRMASI &amp; BAYAR</span></button>
      </div>
    </div>
  </div>
</div>

<script>
function openFlashSaleModal(){
  const m=document.getElementById('fs-modal');
  m.style.display='flex';
  fsGoStep1();
  if(document.getElementById('fs-uid')) document.getElementById('fs-uid').value='';
  if(document.getElementById('fs-zone')) document.getElementById('fs-zone').value='';
  document.getElementById('fs-s2-uid').textContent='ID: —';
  document.body.style.overflow='hidden';
}
function fsClose(){
  document.getElementById('fs-modal').style.display='none';
  document.body.style.overflow='';
}
function fsGoStep1(){
  document.getElementById('fs-s1').style.display='block';
  document.getElementById('fs-s2').style.display='none';
  document.getElementById('fs-dot1').className='fs-step-dot active';
  document.getElementById('fs-dot2').className='fs-step-dot inactive';
}
function fsGoStep2(){
  const uid=document.getElementById('fs-uid').value.trim();
  const zone=document.getElementById('fs-zone').value.trim();
  if(!uid||!zone){alert('Mohon isi User ID dan Zone ID terlebih dahulu!');return;}
  document.getElementById('fs-s2-uid').textContent='ID: '+uid+' ('+zone+')';

  document.getElementById('fs-s1').style.display='none';
  document.getElementById('fs-s2').style.display='block';
  document.getElementById('fs-dot1').className='fs-step-dot done';
  document.getElementById('fs-dot2').className='fs-step-dot active';
}
function fsConfirm(){
  const pay=document.querySelector('input[name="fs_pay"]:checked');
  if(!pay){alert('Pilih metode pembayaran dulu!');return;}
  
  fsClose();
  window.location.href = "{{ url('/checkout') }}";
}
</script>
