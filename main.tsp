import "@typespec/http";

using Http;

@service(#{ title: "Short links Service" })
namespace LinksService;

@route("/api/links")
@tag("Links")
interface Widgets {
  @summary("Создание короткой ссылки")
  @post op create(@body body: {url: string}): {code: string, short_url: string};

  @summary("Статистика по ссылке")
  @route("{code}/stats") @get op stats(@path code: string): {
    url: string;
    code: string;
    clicks: numeric;
    created_at: utcDateTime;
  };
}
